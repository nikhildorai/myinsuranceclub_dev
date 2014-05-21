<?
 echo $a."<br>".$b;
?>		
		<div class="span9">
			<div class="row-fluid" id="charts_main">
				<div class="well">
					<div class="page-header">
					<h1>Active Users</h1>
					<i class="icon-remove"></i>
					</div>
					<div id="placeholder" style="height: 300px;"></div>
				</div>
			</div>
		
			<div class="row-fluid" id="stats_main">
				<div class="span3 well">
					<h3>Total Users</h3>
					<p>
						<a class="badge badge-inverse" href="users.html">563</a>
					</p>
				</div>
				<div class="span3 well">
					<h3>Registered Today</h3>
					<p>
						<a class="badge badge-inverse" href="users.html">100</a>
					</p>
				</div>
				<div class="span3 well">
					<h3>Pending</h3>
					<p>
						<a class="badge badge-inverse" href="users.html">10</a>
					</p>
				</div>
				<div class="span3 well">
					<h3>Active Users</h3>
					<p>
						<a class="badge badge-inverse" href="users.html">15</a>
					</p>
				</div>
			</div><!-- end row_fuild -->

		  <div class="row-fluid well" style="width: 96%;">
			<div class="page-header">
				<h1>Recent Users</h1>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>E-mail</th>
						<th>Registered On</th>
						<th>Role</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<tr class="pending-user">
					<td>186</td>
					<td>Andy Charles</td>
					<td>andy@scriptsjungle.com</td>
					<td>2012-06-06</td>
					<td>User</td>
					<td><span class="label label-success">Active</span></td>
					<td><span class="user-actions"><a href="javascript:void(0);" class="label label-success">Edit</a> <a href="javascript:void(0);" class="label label-important">Delete</a></span></td>
				</tr>
				<tr class="pending-user">
					<td>565</td>
					<td>John K Walsh</td>
					<td>johnk@aol.com</td>
					<td>2012-06-06</td>
					<td>User</td>
					<td><span class="label label-important">Inactive</span></td>
					<td><span class="user-actions"><a href="javascript:void(0);" class="label label-success">Edit</a> <a href="javascript:void(0);" class="label label-important">Delete</a></span></td>
				</tr>
				</tbody>
			</table>
		  </div>
		</div>
		
		
