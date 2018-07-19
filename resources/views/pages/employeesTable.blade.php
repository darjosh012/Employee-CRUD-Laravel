<table id="tableEmployee" class="table table-striped">
            <thead>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Position</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody>
               @foreach($employees as $employee)
               <tr>
                <td>{{$employee['employee_id']}}</td>
                <td>{{$employee['name']}}</td>
                <td>{{$employee['department']}}</td>
                <td>{{$employee['position']}}</td>
                <td><button value="{{$employee['employee_id']}}"type="button" data-name="{{$employee['name']}}" data-department= "{{$employee['department']}}" data-position= "{{$employee['position']}}" class="btn btn-warning editToModal" data-toggle="modal" data-target="#editEmployeeModal">Edit</button></td>
                <td><button type="button" value="{{$employee['employee_id']}}" class="btn btn-danger deleteEmployee">Delete</button></td>
                </tr>
                @endforeach
            </tbody>
 </table>