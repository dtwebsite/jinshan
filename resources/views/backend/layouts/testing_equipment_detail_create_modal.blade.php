@section('testing_equipment_detail_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增項目</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
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
								<input type="number" value="1" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="pid" value="">
					<button type="submit" class="btn btn-secondary float-right">儲存</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- 新增功能End --}}
@endsection
@push('script')
<script type="text/javascript">
	function testing_equipment_detail_create(){
		$('.create').click(function(){
			document.getElementById('create_form').reset();
			$('input[name=pid]').val('');
			var lang = $(this).data('lang');
			$('input[name=lang]').val(lang);
			if(lang == 'en'){
				var pid = $(this).data('pid');
				$('input[name=pid]').val(pid);
			}
			$('#modal-create').modal('show');
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/testing_equipment_detail")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增項目。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				testing_equipment_detail(data);
			}
		})
		return false;
	});
</script>
@endpush