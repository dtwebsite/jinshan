@extends('backend.layouts.main')
@push('style')
<style type="text/css">
	.detail_img img{
		width: 100%;
		min-height:120px;
		display: block;
	}
	.view-first:hover .mask {
		height: 100%;
	}
	.view .tools {
		margin: 88px 0 0 0;
	}
	.detail_img_sort{
		margin-top:3px;
		text-align:center;
		padding-left:30px;
	}
</style>
@endpush
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>編輯花絮<small>Gallery Edit</small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<form id="edit_form" class="form-horizontal form-label-left">
				{{ csrf_field() }}
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">日期</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="date">
						<small class="form-text text-danger">日期格式(年.月.日):日期請務必用" . "作區隔，年用西元年後兩位數，EX: 21.10.27</small>
					</div>
				</div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">標題</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" name="title">
						<small class="form-text text-danger">字數限制:24個中文字內</small>
                    </div>
                </div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">內容</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="content" class="form-control"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">狀態</label>
					<div class="col-md-6 col-sm-6 ">
						<select name="status" class="form-control">
							<option value="1" selected="selected">啟用</option>
							<option value="0">停用</option>
						</select>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">列表排序</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="number" name="sort" class="form-control" min="0" max="99999">
						<small class="form-text text-danger">請輸入花絮的列表排序(由大至小)</small>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">圖片</label>
					<div class="col-md-6 col-sm-6 ">
						<input id="detail_img" type="file" multiple accept="image/*" name="detail_img[]" class="form-control">
						<p class="mt-2">圖片尺寸:<mark>633px X 633px</mark></p>
						<small class="text-danger">*中英文版的花絮圖片，需分開上傳</small><br/>
						<small class="text-danger">*滑入圖片會出現刪除紐，可刪除圖片，圖片排序請直接修改數字，越大越前面</small>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">調整順序及刪除圖片</label>
					<div class="col-md-6 col-sm-6 ">
						<div class="detail_img"></div>
					</div>
				</div>
				<input type="hidden" name="lang" value="">
				<input type="hidden" name="id" value="">
				<input type="hidden" name="_method" value="PUT">
				<div class="ln_solid"></div>
				<div class="item form-group">
					<div class="col text-center">
						<input type="button" onclick="javascript:location.href='{{ asset('admin/gallery') }}'" class="btn btn-secondary" value="上一頁"></input>
						<button type="submit" class="btn btn-success">送出</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	edit_list();
	function edit_list(){
		var gallery_id = location.pathname.replace('/admin/gallery/','');
		var data_lang = location.search.replace('?lang=','');
		document.getElementById('edit_form').reset();
		$.get('{{ asset('admin/gallery') }}/'+gallery_id+'/edit',function(res){
			$.each(res,function(k,v){
				var date = v.date||'';
				var title = v.title||'';
				var content = v.content||'';
				var status = v.status||'';
				var lang = v.lang||'';
				if(lang != data_lang){
					return;
				}else{
					$('[name=date]').val(date);
                    $('[name=title]').val(title);
					$('[name=content]').val(content);
					$('[name=status]').val(status);
					$('[name=sort]').val(v.sort);
					$('[name=lang]').val(lang);
					$('[name=id]').val(v.id);
					var detail_img_str = '';
					$.each(v.detail_img,function(key,value){
						detail_img_str += '<div class="col-md-55">';
						detail_img_str +=	'<div class="thumbnail">';
						detail_img_str += 		'<div class="image view view-first">';
						detail_img_str += 			'<img src="/'+value.img+'" alt="image">';
						detail_img_str += 			'<div class="mask">';
						detail_img_str += 				'<div class="tools tools-bottom">';
						detail_img_str += 					'<a class="detail_img_delete" href="#" data-id="'+value.id+'" onclick="return false"><i class="fa fa-times"></i></a>';
						detail_img_str += 				'</div>';
						detail_img_str += 			'</div>';
						detail_img_str += 		'</div>';
                        detail_img_str +=       '<input class="form-control detail_img_sort" data-id="'+value.id+'" type="number" name="img_sort" value="'+value.img_sort+'">';
						detail_img_str += 	'</div>';
						detail_img_str += '</div>';
					});
					$('.detail_img').html(detail_img_str);
				}
			});

			$('#edit_form').submit(function(){
				var formdata = new FormData(this);
				var id = $('[name=id]').val();
				$.ajax({
					type:"POST",
					url:'{{ asset("admin/gallery")}}/'+id,
					dataType:'json',
					data:formdata,
					async: false,
					cache: false,
					processData: false,
					contentType: false,
					success: function (e) {
						Swal.fire(
						e.message,
						'已修改花絮。',
						e.status
						);
						edit_list();
					}
				})
				return false;
			});

			$('.detail_img_delete').click(function(){
				var delete_id = $(this).data('id');
				Swal.fire({
					title : '確定刪除此圖片嗎？',
					text : '刪除將無法恢復他！',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: '確定刪除！',
					cancelButtonText: '取消刪除！',
				}).then(function(res) {
					if(res.value){
						var data = {id : delete_id,_token : '{{ csrf_token() }}'};
						var url = '{{ asset("admin/gallery_img_delete")}}';
						$.ajax({
							type:"POST",
							url:url,
							dataType:'json',
							data:data,
							success: function (e) {
								Swal.fire(
									e.message,
									'已刪除圖片。',
									e.status
								);
								edit_list();
							}
						})
						return false;
					}
				})
			})

            $('.detail_img_sort').change(function(){
                var sort_id = $(this).data('id');
                var sort = $(this).val();
                var data = {id : sort_id,img_sort : sort,_token : '{{ csrf_token() }}'};
                var url = '{{ asset("admin/gallery_img_sort")}}';
                $.ajax({
                    type:"POST",
                    url:url,
                    dataType:'json',
                    data:data,
                    success: function (e) {
                        Swal.fire(
                            e.message,
                            '已修改排序。',
                            e.status
                        );
                        edit_list();
                    }
                })
                return false;
            })
		});
	}
</script>
@endpush