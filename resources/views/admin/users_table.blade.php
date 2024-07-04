<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">

        {{ __('Users List') }}
        <!-- <div>
            <form action="">
                <input type="text" value="{{$search}}" class="form-control" name="search" placeholder="Search"></input>
            </form>
        </div> -->

    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="task-list" id="task-list">
            <!-- Tasks will be added here dynamically -->
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">tasks #</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>{{$user->tasksQuantity()}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
                
                </table>
                <div class="mt-6">
                <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{$users->appends(request()->input())->links('pagination::bootstrap-4')}}
                </ul>
                </nav>
                </div>
        </div>
    </div>
</div>