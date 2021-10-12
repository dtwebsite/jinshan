@section('certification_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增認證</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">認證圖片</label>
							<div class="col-sm-10">
								<input id="img" type="file" multiple accept="image/*" name="img[]" class="form-control1">
								<p class="mt-2">圖片尺寸:<mark>177px X 177px</mark></p>
							</div>
						</div>
					</div>
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
	document.getElementById("img").required = true;
	function certification_create(){
		$('.create').click(function(){
			$('#modal-create').modal('show');
			document.getElementById('create_form').reset();
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/certification")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增認證。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				certification_list(data);
			}
		})
		return false;
	});
</script>
@endpush