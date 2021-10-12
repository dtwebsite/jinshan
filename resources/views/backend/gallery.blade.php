@extends('backend.layouts.main')
@include('backend.layouts.gallery_create_modal')
@yield('gallery_create_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>花絮列表<small>Gallery List</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增花絮</button>
			<small class="text-danger">*中英文版的花絮圖片，需分開上傳</small>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>日期</th>
							<th>標題</th>
							<th>狀態</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="gallery_list">

					</tbody>
				</table>
			</div>
			<div>
    			<div class="dataTables_paginate paging_simple_numbers">
		    		<ul class="pagination"></ul>
		    	</div>
		    </div>
		    <div>
				<div class="list_total" role="status" aria-live="polite"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var data = {};
	gallery_list(data);
	function gallery_list(data){
		$.get('{{ asset('admin/gallery') }}',data,function(res){
			var gallery_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
                var date = v.date||'';
				var title = v.title||'';
				gallery_data += '<tr>';
				gallery_data += 	'<th scope="row">'+sequence+'</th>';
				gallery_data += 	'<td>'+date+'</td>';
                gallery_data +=  '<td>'+title+'</td>';
				if(v.status){
					status = '<span class="badge badge-success">啟用</span>';
				}else{
					status = '<span class="badge badge-danger">停用</span>';
				}
				gallery_data += 	'<td>'+status+'</td>';
				gallery_data += 	'<td>'+v.sort+'</td>';
				gallery_data += 	'<td>'+date_format(v.created_at)+'</td>';
				gallery_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				gallery_data += 	'<td>';
				if(v.en_check == 1){
					gallery_data +=	'<button type="button" class="btn btn-secondary edit" data-lang="en" data-toggle="modal" data-target="#modal-edit" data-gallery_id="'+v.gallery_id+'">編輯英文版</button>';
				}else{
					gallery_data +=	'<button type="button" class="btn btn-secondary create" data-toggle="modal" data-target="#modal-create" data-lang="en" data-gallery_id="'+v.gallery_id+'">新增英文版</button>';
				}
				gallery_data += '<button type="button" class="btn btn-success edit" data-lang="zh" data-gallery_id="'+v.gallery_id+'" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-gallery_id="'+v.gallery_id+'">刪除</button>';
				gallery_data += 	'</td>';
				gallery_data += '</tr>';
				sequence++;
			});
			$('.gallery_list').html(gallery_data);
			page(res);
			paginate();
			gallery_create();
			gallery_edit();
			gallery_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			gallery_list(data);
		});
	}

	function gallery_edit(){
		$('.edit').click(function(){
			var gallery_id = $(this).data('gallery_id');
			var data_lang = $(this).data('lang');
			window.location.href='/admin/gallery/'+gallery_id+'?lang='+data_lang;
		})
	}

	function gallery_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('gallery_id');
			Swal.fire({
				title : '確定刪除此花絮嗎？',
				text : '刪除將無法恢復他！',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '確定刪除！',
				cancelButtonText: '取消刪除！',
			}).then(function(res) {
				if(res.value){
					var data = {gallery_id : delete_id , _method : 'DELETE',_token : '{{ csrf_token() }}'};
					var url = '{{ asset("admin/gallery")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除花絮。',
								e.status
							);
							var data = {};
							gallery_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush