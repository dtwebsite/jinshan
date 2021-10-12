@section('production_equipment_edit_modal')
{{-- 修改功能Start --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">編輯生產設備圖片</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
								<input type="file" accept="image/*" name="img" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>490px X 300px</mark></p>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-sm-10">
								<input type="number" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="id" value="">
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
	function production_equipment_edit(){
		$('.edit').click(function(){
			$('#modal-edit').modal('show');
			document.getElementById('edit_form').reset();
			var edit_id = $(this).data('id');
			$.get('{{ asset('admin/production_equipment') }}/'+edit_id+'/edit',function(res){
				$('[name=id]').val(res.id);
				$('[name=sort]').val(res.sort);
			});
		})
	}
	$('#edit_form').submit(function(){
		var formdata = new FormData(this);
		var edit_id = $('[name=id]').val();
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/production_equipment")}}/'+edit_id,
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已修改圖片。',
					e.status
				);
				$('#modal-edit').modal('hide');
				var data = {};
				production_equipment_list(data);
			}
		})
		return false;
	});
</script>
@endpush