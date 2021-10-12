@section('production_equipment_detail_edit_modal')
{{-- 修改功能Start --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">編輯項目</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">名稱</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" required="required" placeholder="請輸入項目名稱">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-sm-10">
								<input type="number" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="pid" value="">
					<input type="hidden" name="_method" value="PUT">
					<button type="submit" class="btn btn-secondary float-right">儲存</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- 修改功能End --}}
@endsection
@push('script')
<script type="text/javascript">
	function production_equipment_detail_edit(){
		$('.edit').click(function(){
			$('#modal-edit').modal('show');
			document.getElementById('edit_form').reset();
			var pid = $(this).data('pid');
			var data_lang = $(this).data('lang');
			$('.img_content').html('');
			$.get('{{ asset('admin/production_equipment_detail') }}/'+pid+'/edit',function(res){
				$.each(res,function(k,v){
					var name = v.name||'';
					var lang = v.lang||'';
					if(lang != data_lang){
						return;
					}else{
						$('[name=name]').val(name);
						$('[name=sort]').val(v.sort);
						$('[name=lang]').val(lang);
						$('[name=pid]').val(v.pid);
					}

				});
			});
		})
	}
	$('#edit_form').submit(function(){
		var formdata = new FormData(this);
		var pid = $('[name=pid]').val();
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/production_equipment_detail")}}/'+pid,
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已修改項目。',
					e.status
				);
				$('#modal-edit').modal('hide');
				var data = {};
				production_equipment_detail(data);
			}
		})
		return false;
	});
</script>
@endpush