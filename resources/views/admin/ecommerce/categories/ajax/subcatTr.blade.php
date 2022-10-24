	<tr>
		<td   style="width: 100px;"> Subcat: {{ $loop->iteration }}</td>
		<td >{{$subcat->title}}</td>
		<td style=""> 
		
		<div class="btn-group btn-group-xs float-right" title="Delete Category">
 
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trash"></i>
            </button>
            <ul class="dropdown-menu p-0" role="menu">
 

              <li class="p-0"><a class="w3-btn w3-red w3-small w3-round w3-hover-red btn-subcat-delete" href="{{route('admin.subcatDelete',$subcat)}}" data-url="">Confirm</a></li>
            </ul>
          </div>


		</td>
	</tr>
