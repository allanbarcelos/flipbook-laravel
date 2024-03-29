<nav class="navbar navbar-light navbar-secondary bg-light">
  <div class="container">
      <div class="col-md-7">
        <form class="form-inline">
          <div class="input-group col-md-8">
            <input type="text" class="form-control border-right-0" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            <div class="input-group-append">
              <span class="input-group-text bg-white" id="inputGroup-sizing-default">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>

        </form>
      </div>
      <div class="col-md-5 dropdown-full float-right">
        <div class="dropdown dropdown-full">
          <button class="btn btn-secondary btn-block dropdown-toggle"
                  type="button" id="dropdownMenuButton"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false">

            <span>{{\Carbon\Carbon::now()->format('F Y') }}</span>
            <i class="fa fa-chevron-down"></i>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              @if(isset($months))
              @foreach($months as $value)
                <a class="dropdown-item" href="{{
                    route(
                    'home_edition',
                    [
                        \Carbon\Carbon::createFromFormat('F Y', $value)->format('Y'),
                        \Carbon\Carbon::createFromFormat('F Y', $value)->format('m')
                    ]
                    )
                }}">{{ $value }}</a>
              @endforeach
              @endif

          </div>
        </div>
      </div>
  </div>
</nav>
