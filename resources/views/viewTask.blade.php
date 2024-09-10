@extends('masterlayout.layout')
@section('content')
    <div class="container-fluid">
        <div class="mt-4 mb-5"
            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">ViewTask</li>
            </ol>
        </div>
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title">
                    <h4>
                        Tasks Details
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="container" id="ViewTask">

                </div>
            </div>
        </div>

    </div>
@endsection
<script>
    function viewTask() {
        let currentUrl = window.location.href;
        console.log("Current URL: ", currentUrl);
        let urlSegments = currentUrl.split('/');
        console.log("URL Segments: ", urlSegments);
        let id = urlSegments[urlSegments.length - 1];
        fetch(`/api/tasks/${id}`, {
                method: 'GET',
                headers: {
                    'content-type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.data);
                const task = data.data[0];
                console.log(task);
                var ViewTask = document.getElementById('ViewTask');

                var data = `<h4><b>Title</b> : ${task.title}</h4>
            <br>
            <h4><b>Description</b> : ${task.description}</h4>
            <br>
            <h4><b>Status</b>:`;
            if(task.status == 0){
            data += ` To Do</h4>`;
            }
            if(task.status == 1){
            data += ` In Progress</h4>`;
            }
            if(task.status == 2){
            data += ` Completed</h4>`;
            }
            
                ViewTask.innerHTML = data;
            });
    }

    viewTask();
</script>
