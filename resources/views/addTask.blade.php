@extends('masterlayout.layout')
@section('content')
   <div class="card">
    <div class="car-body">
        <div class="container mt-2">
            <div class="row mb-3 bg-primary text-white">
                <h2>Add New Task</h2>
            </div>
            <form id="addform">
                <div class="row">
                    <div class="col">
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="3" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-select">
                                    <option value="" selected hidden>-- Select Option --</option>
                                    <option value="0">To Do</option>
                                    <option value="1">In Progress</option>
                                    <option value="2">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-primary" onclick="addPost()" id="create"> Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
   </div>
@endsection

<script>
   function addPost(){
        const title = document.querySelector('#title').value;
        const description = document.querySelector('#description').value;
        const status = document.querySelector('#status').value;

        const data = {
            title: title,
            description: description,
            status: status
        };

         fetch('/api/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success){
                window.location.href = '/';
                console.log(data);
            } else {
                console.error('Error creating task:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
