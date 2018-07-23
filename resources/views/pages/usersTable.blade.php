<table id="usersTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($users as $user)
                        <tr>
                            <th>{{$user['id']}}</th>
                            <th>{{$user['name']}}</th>
                            <th>{{$user['nickname']}}</th>
                            <th>{{$user['email']}}</th>
                            <th><button type="button" class="btn btn-warning editUser" data-target="#editUserModal" data-toggle="modal" userid="{{$user['id']}}" name="{{$user['name']}}" nickname="{{$user['nickname']}}" email="{{$user['email']}}">Edit</button>
                            <button type="button" class="btn btn-danger deleteUser" userid= "{{$user['id']}}">Delete</button>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
</main>