<!-- Top row -->
<header id="pageHeader">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/"><img class="img-responsive" src='<% asset_url("frontend/theme2/images/logo.png") %>' alt="PhanKhangHome Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 mr-auto">
                    <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                </form>

                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<% url('/') %>">KHÁM PHÁ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<% url('/#ve-chung-toi') %>">VỀ CHÚNG TÔI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<% url('/danh-muc-san-pham') %>">SẢN PHẨM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<% url('/tin-tuc') %>">TIN TỨC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<% url('/lien-he') %>">LIÊN HỆ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>