@extends('layouts.app')


@section('content')
    <form id="profileForm" enctype="multipart/form-data">
        @csrf
        <label>Adınız</label>
        <input type="text" name="name" id="name" class="form-control">
        <br>
        <div style="display: flex; align-items: center;">
            <label>Profil Fotoğrafınız</label>
            <img src="" alt="" id="previewImage" style="margin: 0 25px; width: 150px;">
            <br>
            <input type="file" name="profilePhoto" id="profilePhoto">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" onclick="handleSubmit()">Güncelle</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        axios.get("http://localhost:8000/api/getprofile/"+{{Auth::user()->id}})
            .then((res)=>{
                console.log(res.data);
                document.querySelector("#name").value = res.data.name;
                document.querySelector("#previewImage").src = res.data.profilePhoto;
            }).catch((e)=>console.log(e));
        
        const handleSubmit = (e) =>{
            const form = document.querySelector("#profileForm");

            const formData = new FormData(form);
            axios.post("http://localhost:8000/api/setprofile/"+{{Auth::user()->id}}, formData)
                .then((res)=>{
                    window.location.href("/home");
                }).catch((e)=>console.log(e));
        };
        
    </script>
@endsection