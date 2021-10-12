@section('sidebar')
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i>儀錶板</a></li>
      <li><a><i class="fa fa-comments-o"></i>關於我們<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/admin/about">簡介圖文</a></li>
          <li><a href="/admin/certification">認證</a></li>
          <li><a href="/admin/production_equipment">生產設備-圖片</a></li>
          <li><a href="/admin/production_equipment_detail">生產設備-項目</a></li>
          <li><a href="/admin/testing_equipment">檢測設備-圖片</a></li>
          <li><a href="/admin/testing_equipment_detail">檢測設備-項目</a></li>
          <li><a href="/admin/client">客戶</a></li>
          <li><a href="/admin/history">歷史</a></li>
          <li><a href="/admin/history_img">歷史-圖片</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-shopping-cart"></i>商品管理<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/admin/products">商品列表</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-tasks"></i>製程管理<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/admin/process">製程列表</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-camera"></i>活動花絮<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/admin/gallery">花絮列表</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-envelope-o"></i>聯絡我們<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/admin/contact">回饋表單</a></li>
        </ul>
      </li>
      <li><a href="/admin/setting"><i class="fa fa-cogs"></i>基本設定</a></li>
    </ul>
  </div>
</div>
@endsection