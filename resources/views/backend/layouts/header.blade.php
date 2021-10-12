@section('header')
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <nav class="nav navbar-nav">
      <ul class="navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('backend/images/img.jpg') }}" alt="">{{ Auth::user()->username }}
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(-88px, 21px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item edit_password" href="javascript:;">修改密碼</a>
            <a class="dropdown-item logout" href="#"><i class="fa fa-sign-out pull-right"></i>登出</a>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>
<div class="modal fade" id="password-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">修改密碼</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="password_edit_form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group row">
              <label class="col-sm-2 control-label">舊密碼</label>
              <div class="col-sm-10">
                <input type="password" name="old_password" class="form-control" required="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label">新密碼</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control"required="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 control-label">確認密碼</label>
              <div class="col-sm-10">
                <input type="password" name="password_confirm" class="form-control" required="">
              </div>
            </div>
          </div>
          <input type="hidden" name="id" value="{{ Auth::user()->id }}">
          <button type="submit" class="btn btn-secondary float-right">儲存</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
  $('.logout').click(function(){
    var data = {_token : '{{ csrf_token() }}'};
    $.ajax({
      type:"POST",
      url:'{{ asset("/logout")}}',
      dataType:'json',
      data:data,
      success: function (e) {
        window.location.href = '{{ asset("/admin")}}';
      }
    })
  })
  $('.edit_password').click(function(){
    $('#password-edit').modal('show');
    document.getElementById('password_edit_form').reset();
  })
  $('#password_edit_form').submit(function(){
    var data = $('#password_edit_form').serialize();
    $.ajax({
      type:"POST",
      url:'{{ asset("admin/change_password")}}',
      dataType:'json',
      data:data,
      success: function (e) {
        if(e.status == 'success'){
          Swal.fire(
            e.message,
            '密碼已修改。',
            e.status
          );
        }else{
          Swal.fire(
            e.message,
            '密碼未修改。',
            e.status
          );
        }
        $('#password-edit').modal('hide');
      }
    })
    return false;
  });
</script>
@endpush