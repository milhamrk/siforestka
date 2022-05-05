<nav class="navigation">

    <div class="container">

		<!--

        <div class="navigation__right">

            <div class="menu--product-categories">

                <div class="menu__toggle"><i class="icon-menu"></i><span>Kategori Produk</span></div>

                <div class="menu__content">

                    <ul class="menu--dropdown">

                        < ?php 

                            $kategori = $this->model_app->view_ordering('rb_kategori_produk','nama_kategori','ASC');

                            foreach ($kategori as $rows) {

                                if ($rows['icon_kode']!=''){

                                    $icon = "<i class='$rows[icon_kode]'></i>";

                                }elseif ($rows['icon_image']!=''){

                                    $icon = "<img style='width:18px; height:18px; margin-right:10px' src='".base_url()."asset/foto_produk/$rows[icon_image]'>";

                                }else{

                                    $icon = "";

                                }

                                $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");

                                if ($sub_kategori->num_rows()>=1){

                                    echo "<li class='current-menu-item menu-item-has-children has-mega-menu'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori] <span class='caret caret-right'></span></a>

                                        <div class='mega-menu'>";

                                        if ($sub_kategori->num_rows()>=10){

                                            $total1 = ceil($sub_kategori->num_rows()/2);

                                            $total2 = floor($sub_kategori->num_rows()/2);

                                            $sub_kategori1 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT 0,$total1");

                                            $sub_kategori2 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT $total1,$total2");

                                            echo "<div class='mega-menu__column'>

                                                <ul class='mega-menu__list'>";

                                            foreach ($sub_kategori1->result_array() as $row) { 

                                                if ($row['icon_kode']!=''){

                                                    $icons = "<i class='$row[icon_kode]'></i>";

                                                }elseif ($row['icon_image']!=''){

                                                    $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";

                                                }else{

                                                    $icons = "";

                                                }

                                                echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";

                                            }

                                            echo "</ul>

                                            </div>";



                                            echo "<div class='mega-menu__column'>

                                                <ul class='mega-menu__list'>";

                                            foreach ($sub_kategori2->result_array() as $row) { 

                                                if ($row['icon_kode']!=''){

                                                    $icons = "<i class='$row[icon_kode]'></i>";

                                                }elseif ($row['icon_image']!=''){

                                                    $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";

                                                }else{

                                                    $icons = "";

                                                }

                                                echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";

                                            }

                                            echo "</ul>

                                            </div>";

                                        }else{

                                            echo "<div class='mega-menu__column'>

                                                <ul class='mega-menu__list'>";

                                            foreach ($sub_kategori->result_array() as $row) { 

                                                if ($row['icon_kode']!=''){

                                                    $icons = "<i class='$row[icon_kode]'></i>";

                                                }elseif ($row['icon_image']!=''){

                                                    $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";

                                                }else{

                                                    $icons = "";

                                                }

                                                echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";

                                            }

                                            echo "</ul>

                                            </div>";

                                        }

                                        echo "</div>

                                    </li>";

                                }else{

                                    echo "<li class='current-menu-item'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori]</a></li>";

                                }

                            }

                        ?>

                    </ul>

                </div>

            </div>

        </div>

		-->

		

        <div class="navigation__right">

        <?php 

                function main_menu() {

                    $ci = & get_instance();

                    $query = $ci->db->query("SELECT id_menu, nama_menu, link, id_parent FROM menu where aktif='Ya' AND position='Bottom' order by urutan");

                    $menu = array('items' => array(),'parents' => array());

                    foreach ($query->result() as $menus) {

                        $menu['items'][$menus->id_menu] = $menus;

                        $menu['parents'][$menus->id_parent][] = $menus->id_menu;

                    }

                    if ($menu) {

                        $result = build_main_menu(0, $menu);

                        return $result;

                    }else{

                        return FALSE;

                    }

                }

        

                function build_main_menu($parent, $menu) {

                    $html = "";

                    if (isset($menu['parents'][$parent])) {

                        if ($parent=='0'){

                            $html .= "<ul class='menu'>";

                        }else{

                            $html .= "<ul class='sub-menu'>";

                        }

                        foreach ($menu['parents'][$parent] as $itemId) {

                            if (!isset($menu['parents'][$itemId])) {

                                if(preg_match("/^http/", $menu['items'][$itemId]->link)) {

                                    $html .= "<li class='current-menu-item'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a><span class='sub-toggle'></span></li>";

                                }else{

                                    $html .= "<li class='current-menu-item'><a href='".base_url().''.$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a><span class='sub-toggle'></span></li>";

                                }

                            }

                            if (isset($menu['parents'][$itemId])) {

                                if(preg_match("/^http/", $menu['items'][$itemId]->link)) {

                                    $html .= "<li class='menu-item-has-children'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";

                                }else{

                                    $html .= "<li class='menu-item-has-children'><a href='".base_url().''.$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";

                                }

                                $html .= build_main_menu($itemId, $menu);

                                $html .= "</li>";

                            }

                        }

                        $html .= "</ul>";

                    }

                    return $html;

                }

                echo main_menu();

            ?>

            <ul class="navigation__extra">

                <?php 

                    $topmenu = $this->model_utama->view_where_ordering_limit('menu',array('position' => 'Top','aktif' => 'Ya'),'urutan','ASC',0,5);

                    foreach ($topmenu->result_array() as $row) {

                        if(preg_match("/^http/", $row['link'])) {

                            echo "<li><a href='$row[link]'>$row[nama_menu]</a></li>";

                        }else{

                            echo "<li><a href='".base_url()."$row[link]'>$row[nama_menu]</a></li>";

                        }

                    }

                ?>

            </ul>

        </div>

    </div>

</nav>