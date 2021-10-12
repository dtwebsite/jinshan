@include('backend.layouts.header')
@include('backend.layouts.sidebar')
@include('backend.layouts.footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}" type="image/ico" />

    <title>金山彩藝</title>

    <!-- Bootstrap -->
    <link href="{{ asset('common/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('common/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="{{ asset('common/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('backend/css/custom.min.css') }}" rel="stylesheet">
    @stack('style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>管理後台</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('backend/images/img.jpg') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->username }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @yield('sidebar')
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        @yield('header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 1646px;">
          @yield('page_content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @yield('footer')
        <!-- /footer content -->
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('common/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('common/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('common/sweetalert/sweetalert2.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            data: {
                'ajax' : 1
            }
        });
    </script>

	@stack('script')
    <script type="text/javascript">
        function date_format(time){
            var time = new Date(time);
            return time.toLocaleString();
        }

        function page(res){
            var previous = res.current_page -1 == 0 ? 'disabled' : 'paginate_button';
            var next = res.current_page == res.last_page ? 'disabled' : 'paginate_button';
            var page = '<li class="previous '+previous+'" data-id="'+(res.current_page-1)+'">\
                            <a href="#" data-dt-idx="0" tabindex="0">上一頁</a>\
                        </li>';
            for(i=1;i<=res.last_page;i++){
                var nowpage = res.current_page == i ? 'disabled' : 'paginate_button';
                page += '<li class="'+nowpage+'" data-id="'+i+'">'+
                            '<a href="#" data-dt-idx="'+i+'" tabindex="0">'+i+'</a>'+
                        '</li>';
            }
            page += '<li class="next '+next+'" data-id="'+(res.current_page+1)+'">\
                        <a href="#" data-dt-idx="7" tabindex="0">下一頁</a>\
                    </li>';
            $('.pagination').html(page);
            var from = res.from||0;
            var to = res.to||0;
            var total='第'+from+'至'+to+'筆，總共'+res.total+'筆';
            $('.list_total').html(total);
        }
    </script>
  </body>
</html>