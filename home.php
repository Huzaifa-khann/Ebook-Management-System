 <!-- Header-->
 <header class="bg-dark py-5" id="main-header">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">If you want to make intelligent, get books from here.</h1>
            <p class="lead fw-normal text-white-50 mb-0">Shop Now!</p>
        </div>
    </div>
</header>
<!-- Section-->
<style>
    .book-cover{
        object-fit:contain !important;
        height:auto !important;
    }
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
.button button{
  position: relative;
  height: 50px;
  width: 100px;
  margin: 0 40px;
  font-size: 23px;
  font-weight: 500;
  letter-spacing: 1px;
  border-radius: 5px;
  text-transform: uppercase;
  border: 1px solid transparent;
  outline: none;
  cursor: pointer;
  background: white;
  overflow: hidden;
  transition: 0.6s;
}
.button button:first-child{
  color: #206592;
  border-color: #206592;
}
.buttonbutton:last-child{
  color: #ce5c0c;
  border-color: #ce5c0c;
}
.buttonbutton:before, button:after{
  position: absolute;
  content: '';
  left: 0;
  top: 0;
  height: 100%;
  filter: blur(30px);
  opacity: 0.4;
  transition: 0.6s;
}
.button button:before{
  width: 60px;
  background: white;
  transform: translateX(-130px) skewX(-45deg);
}
.button button:after{
  width: 30px;
  background: blue;
  transform: translateX(-130px) skewX(-45deg);
}
.button button:hover:before,
.button button:hover:after{
  opacity: 0.6;
  transform: translateX(320px) skewX(-45deg);
}
.button button:hover{
  color: blue;
}
.button button:hover:first-child{
  background: #206592;
}
.button button:hover:last-child{
  background: white;
}
.button button a{
    text-decoration:none;
} 
</style>
<div class="block-header" style="margin-top:  50px;">
<h2 class="block-title" style="    color: #616161; font-weight: 700; font-size: 20px; text-transform: uppercase; margin-bottom: 25px;     margin-left: 26px;">browse generes</h2>
<a href="" style="    position: absolute;
    color: #337ab7;
    text-decoration: none;
    margin-left: 211px;
    margin-top: -47px;">(view all)</a>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-4 row-cols-xl-4 justify-content-center">
           
            <?php 
                $whereData = "";
                $categories = $conn->query("SELECT * FROM `categories` where status = 1 order by category asc ");
                while($row = $categories->fetch_assoc()):
                    foreach($row as $k=> $v){
                        $row[$k] = trim(stripslashes($v));
                    }
                    $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
            ?>
            <div class="col mb-6 mb-2">
                <a href="./?p=products&c=<?php echo md5($row['id']) ?>" class="card category-item text-dark">
                    <div class="card-body p-4">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="fw-bolder "><?php echo $row['category'] ?></h5>
                        </div>
                      
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<div class="block-header">
<h2 class="block-title" style="    color: #616161; font-weight: 700; font-size: 20px; text-transform: uppercase; margin-bottom: 25px;     margin-left: 26px;">editor's choice</h2>
<a href="" style="    position: absolute;
    color: #337ab7;
    text-decoration: none;
    margin-left: 211px;
    margin-top: -47px;">(view all)</a>
</div>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php 
                $products = $conn->query("SELECT * FROM `products` where status = 1 order by rand() limit 8 ");
                while($row = $products->fetch_assoc()):
                    $upload_path = base_app.'/uploads/product_'.$row['id'];
                    $img = "";
                    if(is_dir($upload_path)){
                        $fileO = scandir($upload_path);
                        if(isset($fileO[2]))
                            $img = "uploads/product_".$row['id']."/".$fileO[2];
                        // var_dump($fileO);
                    }
                    foreach($row as $k=> $v){
                        $row[$k] = trim(stripslashes($v));
                    }
                    $inventory = $conn->query("SELECT * FROM inventory where product_id = ".$row['id']);
                    $inv = array();
                    while($ir = $inventory->fetch_assoc()){
                        $inv[] = number_format($ir['price']);
                    }
            ?>
            <div class="col mb-5" style="border-radius:50px;height:500px;">
                <div class="card product-item">
                    <!-- Product image-->
                    <img class="card-img-top w-100 book-cover" src="<?php echo validate_image($img) ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $row['title'] ?></h5>
                            <!-- Product price-->
                            <?php foreach($inv as $k=> $v): ?>
                                <span><b>Price: </b><?php echo $v ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="m-0"><small>By: <?php echo $row['author'] ?></small></p>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                    <div class="button">
                       <button><a href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a></button> 
                    </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
</section>