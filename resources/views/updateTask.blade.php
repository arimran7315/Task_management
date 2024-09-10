@extends('masterlayout.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3 bg-primary text-white">
                    <h2>Update Task</h2>
                </div>
                <form>
                    <input type="hidden" id="email" value="{{Auth::user()->email}}">
                    <div class="row">
                        <div class="col" id="addform">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function viewTask() {
        let currentUrl = window.location.href;
        let urlSegments = currentUrl.split('/');
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
                var ViewTask = document.getElementById('addform');

                var data = `
                 <div class="row mb-3">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="${task.title}" id="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="3" id="description">${task.description}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-select">`;
                if (task.status == 0) {

                    data += ` <option value="0" selected>To Do</option>
                                       <option value="1">In Progress</option>
                                    <option value="2">Completed</option>`;
                }
                if (task.status == 1) {

                    data += ` <option value="0" >To Do</option>
<option value="1" selected>In Progress</option>
<option value="2">Completed</option>`;
                }
                if (task.status == 2) {

                    data += ` <option value="0" >To Do</option>
<option value="1">In Progress</option>
<option value="2" selected>Completed</option>`;
                }
                data += `
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-primary" onclick="updatePost(${task.id})" id="create"> update</button>
                            </div>
                        </div>`;

                ViewTask.innerHTML = data;
            });
    }

    viewTask();

    function updatePost(id) {
        const email = document.querySelector('#email').value;
        const title = document.querySelector('#title').value;
        const description = document.querySelector('#description').value;
        const status = document.querySelector('#status').value;

        const data = {
            email: email,
            title: title,
            description: description,
            status: status
        };

        fetch(`/api/tasks/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-HTTP-Method-Override': 'PUT',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    viewTask();
                    console.log(data);
                } else {
                    console.error('Error creating task:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
