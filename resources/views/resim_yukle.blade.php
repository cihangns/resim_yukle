@extends('layouts.app')


@section('content')
  <div class="container mt-4">
    <br><br>
    <form id="fileUploadForm" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="userid" value="{{Auth::user() ? Auth::user()->id : "1"}}">{{-- buraya sıfır gelecek userid yoksa--}} 
      <input type="file" class="form-control" name="files[]" id="fileInput" multiple>
      <button type="button" class="btn btn-primary mt-3 mb-3" onclick="uploadFiles()">Yükle</button>
      <div class="alert alert-danger" id="fileError" style="display: none;">
      </div>
    </form>
    <div id="response"></div>

    {{-- @foreach($tumResimler as $row)
      <div>
        <img src="{{$row->image_url}}" height="300" alt="" id="resim" >
        <input type="text" size="60" value="{{$row->image_url}}" disabled> 
      </div>
      <br>
    @endforeach --}}
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
      function uploadFiles() {
          const fileInput = document.querySelector('#fileInput');
          const fileError = document.querySelector("#fileError");
          const maxFileSize = 1 * 1024 * 1024;
          const fileExtensions = ["image/jpg", "image/png", "image/jpeg"];

          for (const file of fileInput.files) {
            if (!fileExtensions.includes(file.type)) {
              fileError.innerHTML = "Girilen Dosya Türleri (.jpg, .png, .jpeg) olmalıdır.";
              return fileError.style = "display: block;";
              
            }
            if (file.size > maxFileSize) {
              fileError.innerHTML = "Girilen Dosya En Fazla 1 Mb olmalıdır";
              return fileError.style = "display: block;";
            }
            fileError.style = "display: none;";
          }

          const form = document.getElementById('fileUploadForm');
          const formData = new FormData(form);


          axios.post('http://localhost:8000/api/upload', formData, {
              headers: {
                  'Content-Type': 'multipart/form-data',
              },
              onUploadProgress: progressEvent => {
                  const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                  console.log(percentCompleted);
              },
          })
          .then(response => {
            console.log(response.data);
            response.data.forEach(link => {
              document.getElementById('response').innerHTML = '<p>'+response.data+'</p>';
            });
          })
          .catch(error => {
              document.getElementById('response').innerHTML = 'Yükleme sırasında bir hata oluştu.';
              console.error(error);
          });
      }
  </script>
@endsection