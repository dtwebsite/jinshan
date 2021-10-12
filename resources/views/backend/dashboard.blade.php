@extends('backend.layouts.main')
@section('page_content')
<div class="w-100">
<!-- <div class="tile_count"> -->
    <h3>關於我們</h3>
    <div class="row mt-2 mb-4">
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/certification">
            <div style="background-color:#1c99aa;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-certificate"></i></div>
            <div style="background-color:#1c99aa;" class="count_txt pb-2 text-center w-100 text-white">認證</div>
            <div class="count display-1 my-2">{{ $certification }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/production_equipment">
            <div style="background-color:#1c8fa9;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-file-image-o"></i></div>
            <div style="background-color:#1c8fa9;" class="count_txt pb-2 text-center w-100 text-white">生產設備-圖片</div>
            <div class="count display-1 my-2">{{ $production_equipment }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/production_equipment_detail">
            <div style="background-color:#1c85a8;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-sitemap"></i></div>
            <div style="background-color:#1c85a8;" class="count_txt pb-2 text-center w-100 text-white">生產設備-項目</div>
            <div class="count display-1 my-2">{{ $production_equipment_detail }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/testing_equipment">
            <div style="background-color:#1c7095;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-file-image-o"></i></div>
            <div style="background-color:#1c7095;" class="count_txt pb-2 text-center w-100 text-white">檢測設備-圖片</div>
            <div class="count display-1 my-2">{{ $testing_equipment }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/testing_equipment_detail">
            <div style="background-color:#1a678c;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-sitemap"></i></div>
            <div style="background-color:#1a678c;" class="count_txt pb-2 text-center w-100 text-white">檢測設備-項目</div>
            <div class="count display-1 my-2">{{ $testing_equipment_detail }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/client">
            <div style="background-color:#17567c;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-users"></i></div>
            <div style="background-color:#17567c;" class="count_txt pb-2 text-center w-100 text-white">客戶</div>
            <div class="count display-1 my-2">{{ $client }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/history">
            <div style="background-color:#165076;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-history"></i></div>
            <div style="background-color:#165076;" class="count_txt pb-2 text-center w-100 text-white">歷史</div>
            <div class="count display-1 my-2">{{ $history }}</div>
          </a>
        </div>
      </div>
      <div class="col- tile_stats_count my-2 p-2" style="min-width:180px;">
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/history_img">
            <div style="background-color:#154970;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-file-image-o"></i></div>
            <div style="background-color:#154970;" class="count_txt pb-2 text-center w-100 text-white">歷史-圖片</div>
            <div class="count display-1 my-2">{{ $history_img }}</div>
          </a>
        </div>
      </div>
    </div>

    <div class="row mt-2 mb-4">
      <div class="col- my-2 p-2" style="min-width:280px;">
        <h3>商品管理</h3>
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/products">
            <div style="background-color:#154970;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-shopping-cart"></i></div>
            <div style="background-color:#154970;" class="count_txt pb-2 text-center w-100 text-white">商品列表</div>
            <div class="count display-1 my-2">{{ $products }}</div>
          </a>
        </div>
      </div>
      <div class="col- my-2 p-2" style="min-width:280px;">
        <h3>製程管理</h3>
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/process">
            <div style="background-color:#1c7095;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-tasks"></i></div>
            <div style="background-color:#1c7095;" class="count_txt pb-2 text-center w-100 text-white">製程列表</div>
            <div class="count display-1 my-2">{{ $process }}</div>
          </a>
        </div>
      </div>
      <div class="col- my-2 p-2" style="min-width:280px;">
        <h3>聯絡我們</h3>
        <div class="bg-light shadow rounded-lg d-flex flex-column align-items-center justify-content-center">
          <a class="text-center w-100" href="/admin/contact">
            <div style="background-color:#1c99aa;" class="count_top rounded-top pt-3 pb-2 text-center w-100 text-white"><i class="fa-2x fa fa-envelope-o"></i></div>
            <div style="background-color:#1c99aa;" class="count_txt pb-2 text-center w-100 text-white">回饋表單</div>
            <div class="count display-1 my-2">{{ $contact }}</div>
          </a>
        </div>
      </div>
    </div>

</div>
@endsection