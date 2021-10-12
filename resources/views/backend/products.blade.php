@extends('backend.layouts.main')
@include('backend.layouts.products_create_modal')
@yield('products_create_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>商品列表<small>Products List</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增商品</button>
			<small class="text-danger">*中英文版的商品圖片，需分開上傳</small>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>商品名稱</th>
							<th>圖片</th>
							<th>狀態</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="products_list">

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
	products_list(data);
	function products_list(data){
		$.get('{{ asset('admin/products') }}',data,function(res){
			var products_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var name = v.name||'';
				var img = v.img||'';
				products_data += '<tr>';
				products_data += 	'<th scope="row">'+sequence+'</th>';
				products_data += 	'<td>'+name+'</td>';
				products_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				if(v.status){
					status = '<span class="badge badge-success">啟用</span>';
				}else{
					status = '<span class="badge badge-danger">停用</span>';
				}
				products_data += 	'<td>'+status+'</td>';
				products_data += 	'<td>'+v.sort+'</td>';
				products_data += 	'<td>'+date_format(v.created_at)+'</td>';
				products_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				products_data += 	'<td>';
				if(v.en_check == 1){
					products_data +=	'<button type="button" class="btn btn-secondary edit" data-lang="en" data-toggle="modal" data-target="#modal-edit" data-product_id="'+v.product_id+'">編輯英文版</button>';
				}else{
					products_data +=	'<button type="button" class="btn btn-secondary create" data-toggle="modal" data-target="#modal-create" data-lang="en" data-product_id="'+v.product_id+'">新增英文版</button>';
				}
				products_data += '<button type="button" class="btn btn-success edit" data-lang="zh" data-product_id="'+v.product_id+'" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-product_id="'+v.product_id+'">刪除</button>';
				products_data += 	'</td>';
				products_data += '</tr>';
				sequence++;
			});
			$('.products_list').html(products_data);
			page(res);
			paginate();
			products_create();
			products_edit();
			products_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			products_list(data);
		});
	}

	function products_edit(){
		$('.edit').click(function(){
			var product_id = $(this).data('product_id');
			var data_lang = $(this).data('lang');
			window.location.href='/admin/products/'+product_id+'?lang='+data_lang;
		})
	}

	function products_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('product_id');
			Swal.fire({
				title : '確定刪除此商品嗎？',
				text : '刪除將無法恢復他！',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '確定刪除！',
				cancelButtonText: '取消刪除！',
			}).then(function(res) {
				if(res.value){
					var data = {product_id : delete_id , _method : 'DELETE',_token : '{{ csrf_token() }}'};
					var url = '{{ asset("admin/products")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除商品。',
								e.status
							);
							var data = {};
							products_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush