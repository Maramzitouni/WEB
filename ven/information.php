<?php include ('navbar.php');



$product1=find_product_by_id($_GET['pid']);

 ?>
<section class="main">

   <!-- Toutes les cartes -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

     <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" href="styles.css" />

<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />





       <main id="main">
         <div class="container">

           <section class="section product-details__section">
             <div class="product-detail__container">
               <div class="product-detail__left">
                 <div class="details__container--left">

                   <div class="product__picture" id="product__picture">

                     <div class="picture__container">
                       <img src="product_images/<?=$product1['product_image']?>" id="pic" />
                     </div>
                   </div>
                   <div class="zoom" id="zoom"></div>
                 </div>

                 <div class="product-details__btn">
                   <a class="buy" href="#">
                     <span>
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-credit-card"></use>
                       </svg>
                     </span>
                     Acheter
                   </a>
                 </div>
               </div>

               <div class="product-detail__right">
                 <div class="product-detail__content">
                   <h3><?=$product1['product_title']?></h3>
                   <div class="price">
                     <span class="new__price"><?=$product1['product_price']?></span>
                   </div>
                   <div class="product__review">
                     <div class="rating">
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                       </svg>
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                       </svg>
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                       </svg>
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                       </svg>
                       <svg>
                         <use xlink:href="./images/sprite.svg#icon-star-empty"></use>
                       </svg>
                     </div>
                     <a href="#" class="rating__quatity">3 reviews</a>
                   </div>
                   <p>
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                     a doloribus iste natus et facere?
                     dolor sit amet consectetur adipisicing elit. Sunt
                     a doloribus iste natus et facere?
                   </p>
                   <div class="product__info-container">
                     <ul class="product__info">

                       <li>


                       </li>

                       <li>
                         <span>total:</span>
                         <a href="#" class="new__price"><?=$product1['product_price']?>euros</a>
                       </li>
                       <li>
                         <span>Marque:</span>
                         <a href="#">Apple</a>
                       </li>
                       <li>
                         <span> Type:</span>
                         <a href="#">Phone</a>
                       </li>
                       <li>
                         <span>Disponibilité:</span>
                         <a href="#" class="in-stock">En Stock (<?php echo $product1['product_qty'] ?> Produits)</a>
                       </li>
                     </ul>
                     <div class="product-info__btn">
                       <a href="#">
                         <span>
                           <svg>
                             <use xlink:href="./images/sprite.svg#icon-crop"></use>
                           </svg>
                         </span>&nbsp;
                         Guide de taille
                       </a>
                       <a href="#">
                         <span>
                           <svg>
                             <use xlink:href="./images/sprite.svg#icon-truck"></use>
                           </svg>
                         </span>&nbsp;
                         Livraison
                       </a>
                       <a href="#">
                         <span>
                           <svg>
                             <use xlink:href="./images/sprite.svg#icon-envelope-o"></use>
                           </svg>&nbsp;
                         </span>
                         Questions ?
                       </a>
                     </div>
                   </div>
                 </div>
               </div>
             </div>


             </div>
           </section>



</main>











           <footer style="margin-top:500px">
                  <div class="footer-title">
                    <h1 class="Marybe-blanc">LoyaltyCard</h1>
                  </div>

                  <div class="nav-container-footer">
                      <section class="heading-titles">
                          <p>SERVICES EN LIGNE</p>
                          <ul>
                             <li><a href="#">FAQ</a></li>
                             <li><a href="#">Livraison</a></li>
                             <li><a href="#">Paiements</a></li>
                             <li><a href="#">Contact</a></li>
                          </ul>
                      </section>



                      <section class="heading-titles">
                           <p>À PROPOS</p>
                           <ul>
                             <li><a href="#">Qui-Sommes-Nous?</a></li>
                           </ul>
                      </section>



                      <section class="heading-titles">
                           <p>MENTIONS LÉGALES</p>
                           <ul>
                               <li><a href="#">Politique de confidentialité</a></li>
                               <li><a href="#">Politique relative aux cookies</a></li>
                               <li><a href="#">Conditions générales de vente</a></li>
                               <li><a href="#">Conditions générales d'utilisation</a></li>
                           </ul>
                      </section>


                  </div>

                  <div class="contact-us">
                      <ul>
                          <li>
                             <a href="https://www.instagram.com/marybe_paris/">
                                 <img src="images/instagram.png">
                             </a>

                          </li>
                          <li>
                             <a href="#">
                                 <img src="images/facebook.png">
                             </a>
                         </li>
                      </ul>
                  </div>


              </footer>














       <script src="./js/products.js"></script>
       <script src="./js/index.js"></script>
       <script src="./js/slider.js"></script>










</body>

<!-- End ConveyThis code -->
</html>
