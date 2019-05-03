<!DOCTYPE html>
<html lang="en">
  @include('dashboard-views.layouts.header')
  <body>
    <div class="container-scroller" id="app">
      @include('dashboard-views.layouts.head-nav')
      <div class="container-fluid page-body-wrapper">
        @include('dashboard-views.layouts.side-nav')
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <router-view></router-view>
            </div>
          </div>
          @include('dashboard-views.layouts.footer')
        </div>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @include('dashboard-views.layouts.scripts')
  </body>
</html>
