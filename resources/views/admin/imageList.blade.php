@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<style>
    .activePag{
        color: black;
        background-color: white;
    }
</style>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Resim</th>
            <th scope="col">Resim URL</th>
            <th scope="col">İşlemler</th>
        </tr>
    </thead>
    <tbody id="items">
    </tbody>
  </table>
  <br>
  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups" style="justify-content: center">
    <div class="btn-group me-2" role="group" aria-label="First group" id="pagibtnGroup">
      {{-- pagination buttonlar buraya Gelecekler  --}}
    </div>
  </div>

  <script>
    
    axios.get("http://localhost:8000/api/paginationimage/"+{{Auth::user()->id}}+"?limit=6&offset=0")
        .then((res)=>{
            res.data.images.forEach(items => {
                document.querySelector("#items").innerHTML += `
                    <tr>
                        <td><img src="${items.image_url}" alt="asd" style="width:100px; height:75px"></td>
                        <td>${items.image_url}</td>
                        <td>
                            <button class="btn btn-danger btn-sm me-2" onclick="deleteItem(${items.id})">Sil</button>
                        </td>
                    </tr>
                `;
            });
            console.log(res.data);
            const pageCount = Math.ceil(res.data.count / 5);
            let btnValue = 0; 
            let isFirstBtn = false;
            console.log(pageCount);
            for (let x = 1; x <= pageCount; x++) {
                document.querySelector("#pagibtnGroup").innerHTML += `
                    <button type="button" class="btn btn-primary" value="${btnValue}" id="pagBtn">${x}</button>
                `;
                btnValue += 5;
            }
        }).catch((e)=>console.log(e));

    const deleteItem = (id, userid) =>{
        if (confirm("Silmek İstediğinizden Emin misiniz?")) {
            axios.delete(`http://localhost:8000/api/images/${id}/`+{{Auth::user()->id}}).then(()=>{
                window.location.reload();
            }).catch((e)=>console.log(e))
        }
    };

    let previousBtn;
    setTimeout(() => {
        document.querySelectorAll("#pagBtn").forEach((btn)=>{
            btn.addEventListener("click", ()=>{
                previousBtn && previousBtn.classList.remove("activePag");
                btn.classList.add("activePag");

                axios.get(`http://localhost:8000/api/paginationimage/`+{{Auth::user()->id}}+`?limit=5&offset=${btn.value}`)
                    .then((res)=>{
                        document.querySelector("#items").innerHTML = ``;
                        res.data.images.forEach((items)=>{
                            document.querySelector("#items").innerHTML += `
                            <tr>
                                <td>${items.id}</td>
                                <td><img src="${items.image_url}" alt="asd" style="width:100px; height:75px"></td>
                                <td>${items.image_url}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm me-2" onclick="deleteItem(${items.id})">Sil</button>
                                </td>
                            </tr>
                            `;
                        })
                    }).catch((e)=>console.log(e));
                previousBtn = btn;
            });
        });
    }, 2000);
    

  </script>
@endsection