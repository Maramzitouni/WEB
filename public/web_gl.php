<!--
CA NE MARCHE PAS ENCORE VU QUE LA BIBLIOTHEQUE N'EST PAS PRISE EN COMPTE PTDRRRRR
JE VAIS ESSAYER DE METTRE A JOUR LE CODE EN LOCAL AVANT DE L'ADD ICI
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Simulation</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link type="text/css" rel="stylesheet" href="main.css">
		<script type="importmap">
			 {
					 "imports": {
							 "three": "https://unpkg.com/three@0.138.0/build/three.module.js",
							 "FirstPersonControls": "https://unpkg.com/three@0.138.0/examples/jsm/controls/FirstPersonControls.js"
					 }
			 }
	 </script>
	</head>
	<body>

		<!-- Import maps polyfill -->
		<!-- Remove this when import maps will be widely supported -->

		<?php
		$dir    = '../ven/product_images';
		$files1 = scandir($dir, 1);
			//compte le nombre de fichier présent dans le dossier product_images
		$nb_file= count($files1)-2;
		echo $nb_file;
		?>


		<script type="module">

				import * as THREE from './three_js-master/build/three.module.js';
			//	import { FirstPersonControls } from '/public/three_js-master/examples/jsm/controls/FirstPersonControls.js';
				import { FirstPersonControls } from './three_js-master/examples/jsm/controls/FirstPersonControls.js';
				const clock = new THREE.Clock();
				//import { InstancedBufferAttribute } from '/public/three_js-master/core/InstancedBufferAttribute.js';

			let camera, scene, scene_m=[], renderer;
			var count = '<?php echo $nb_file; ?>';
			//let amount = parseInt( window.location.search.slice( 1 ) ) || 20;

			let boxes=[];
			let i=0,y=0;
			let raycaster, mouse;
			let planche=[], arriere, controls, side=[];
			let pos;
			let group;
			//var clickableObjs   = new Array();
			const color = new THREE.Color();
			const green_l= new THREE.Color().setHex(0xE43A9A);
			const pink_l= new THREE.Color().setHex(0x2A85A0);





			init();
			animate();

					function init() {

								camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 5000 );
								camera.position.z = 400;
								camera.position.y = -190;


								scene = new THREE.Scene();
								scene.background = new THREE.Color(0xffffff);

								group = new THREE.Group();

								let materialArray = [];
								let texture_ft = new THREE.TextureLoader().load( './images/wall_gl.jpg');
								let texture_bk = new THREE.TextureLoader().load( './images/wall_gl.jpg');
								let texture_up = new THREE.TextureLoader().load( './images/ceiling_gl.jpg');
								let texture_dn = new THREE.TextureLoader().load( './images/floor_gl.jpg');
								let texture_rt = new THREE.TextureLoader().load( './images/wall_gl.jpg');
								let texture_lf = new THREE.TextureLoader().load( './images/wall_gl.jpg');

								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_ft }));
								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_bk }));
								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_up }));
								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_dn }));
								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_rt }));
								materialArray.push(new THREE.MeshBasicMaterial( { map: texture_lf }));

								for (let l = 0; l < 6; l++)
								  materialArray[l].side = THREE.BackSide;

								let skyboxGeo = new THREE.BoxGeometry( 1000, 600, 1000);
								let skybox = new THREE.Mesh( skyboxGeo, materialArray );
								skybox.position.y=0;
								scene.add( skybox );


//const texture_box = new THREE.TextureLoader().load( 'textures/etoile.webp' );
								const geometry_box = new THREE.BoxGeometry( 20, 20, 20 );
								const material_box = new THREE.MeshBasicMaterial( { color: 0xE43A9A });
								//box.length= count;
								let k = 0;
								for (var j = 0; j < 9; j++) {
										const box = new THREE.Mesh( geometry_box, material_box );
								//box[j].position.x=-75;
										if (j<3) {
												box.position.y=-144;
												if (j==0) {
															box.position.x=-65;
														}
												if (j!=0) {
														box.position.x=k+65;
														}
										}

										if(j>=3 && j<6){
												box.position.y=-187,5;
												if (j==3) {
													box.position.x=-65;
												}
												if (j!=3) {
													box.position.x=k+65;
												}
										}

									if (j>=6 && j<9) {
											box.position.y=-232;
											if (j==6) {
												box.position.x=-65;
											}
											if (j!=6) {
												box.position.x=k+65;
											}
									}
								//	console.log(k);
									boxes.push(box);
									group.add( box );
									k=box.position.x;
								//	console.log(j);
								}

															// MEUBLE
								let furniture_1 = new THREE.TextureLoader().load( './images/armoire_claire.jpg');
								const material_f1= new THREE.MeshBasicMaterial( { map: furniture_1 } );
								let furniture_2 = new THREE.TextureLoader().load( './images/armoire.jpg');
								const material_f2= new THREE.MeshBasicMaterial( { map: furniture_2 } );
								let nb_m = count/9;
								const parsed = parseInt(nb_m);
								console.log(parsed);



									const geometry_side = new THREE.BoxGeometry(5,185.5,30);
									for (var m = 0; m < 3; m++) {
										side[m] = new THREE.Mesh( geometry_side, material_f2 );
										side[m].position.y=-200;
										side[m].position.x=-80;
										if (m%2==0) {
											side[m].position.x=80;
										}
										group.add( side[m]);
									}

									const geometry_planche = new THREE.BoxGeometry(160,1.5,25);
									for (var n = 0; n < 5; n++) {
										planche[n] = new THREE.Mesh( geometry_planche, material_f1 );
										planche[4] = new THREE.Mesh( geometry_planche, material_f2 );
										if (n==0) {
											planche[n] = new THREE.Mesh( geometry_planche, material_f2 );
													planche[n].position.y=-290;

										}
										if (n!= 0) {
													planche[n].position.y=pos+45;
										}
										pos = planche[n].position.y;
										group.add( planche[n]);
									}

									const geometry_arriere = new THREE.BoxGeometry(160,185.5,2);
									arriere= new THREE.Mesh( geometry_arriere, material_f2);
									arriere.position.y=-200;
									arriere.position.z = -15;
									group.add(arriere);

									scene.add(group);


								let group_test = [];
								group_test.length= parsed;
								let pos_clone=0,adding=0,new_pos=0;
								for (var c = 1; c < group_test.length; c++) {
									if (c < 1 ) {
										pos_clone = group_test[c].position.z;
									}
									group_test[c] = group.clone();

									let reset= group_test[c].position.z;
									if (c<3) {
										//pos_clone = group_test[c].position.z ;
										adding = 100;
										group_test[c].position.z=pos_clone+adding;
									}else{
										adding = 100;
										if (c == 3) {
											group_test[c].position.z = reset;
											pos_clone = group_test[c].position.z;
											adding = 0;
										}
										//pos_clone = group_test[c].position.z;
										group_test[c].position.z = pos_clone + adding;
										group_test[c].position.x = 300;
									}

									scene.add(group_test[c]);
								}

																		//FIN MEUBLE


								renderer = new THREE.WebGLRenderer( { antialias: true } );
								renderer.setPixelRatio( window.devicePixelRatio );
								renderer.setSize( window.innerWidth, window.innerHeight );
								document.body.appendChild( renderer.domElement );

								controls = new FirstPersonControls( camera, renderer.domElement );

									controls.movementSpeed = 70;
									controls.lookSpeed = 0.05;
									controls.noFly = true;
									controls.activeLook = false;
									controls.keys = {
											UP: 'ArrowUp', // up arrow
											//RIGHT: 'ArrowRight', // right arrow
											BOTTOM: 'ArrowDown' // down arrow
										}
									/* FAIRE LA ROTATION G/D*/

								raycaster = new THREE.Raycaster();
								mouse = new THREE.Vector2();


								function onClick(event) {
																//CALCUL DE LA POSITION DE LA SOURIS DANS L'ÉCRAN
									mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
									mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

									 raycaster.setFromCamera(mouse, camera);

									const intersects = raycaster.intersectObjects( boxes, false );


									console.log(intersects.length > 0 ? "yes" : "no");
									if (intersects.length > 0  ) {
										//let INTERSECTED = intersects[ 0 ].box;



														intersects[0].object.material.color.setHex( Math.random() * 0xffffff  );
							}
						}




						function setColorAt( index, color ) {
								if ( instanceColor === null ) {
									instanceColor = new InstancedBufferAttribute( new Float32Array( instanceMatrix.count * 3 ), 3 );
								}
								color.toArray( instanceColor.array, index * 3 );
							}


								window.addEventListener( 'resize', onWindowResize );
								window.addEventListener('click', onClick,false);
							//	window.addEventListener( 'click', Clicked  );

/*											function Clicked(){
															i=i+1;
//	console.log(i);
															scene.remove(box);
//	const geometry_box2 = new THREE.BoxGeometry( 200, 100, 100 );
															if(i%2==0){

																			box = new THREE.Mesh( geometry_box, material_box );

															}else{

																			const material_box2 = new THREE.MeshBasicMaterial({color: 0xff0000});
																			box = new THREE.Mesh(geometry_box, material_box2);

															}
															scene.add(box);
											}*/


					function onWindowResize() {

								camera.aspect = window.innerWidth / window.innerHeight;
								camera.updateProjectionMatrix();
								renderer.setSize( window.innerWidth, window.innerHeight );
							 	controls.handleResize();

					}

					function randInt( low, high ) {

						return low + Math.floor( Math.random() * ( high - low + 1 ) );

			}

			function getColorAt( index, color ) {
					color.fromArray( instanceColor.array, index * 3 );
			}


	/*		const loader = new FontLoader();

loader.load( 'fonts/helvetiker_regular.typeface.json', function ( font ) {

	const geometry = new TextGeometry( 'Loyalty', {
		font: font,
		size: 80,
		height: 5,
		curveSegments: 12,
		bevelEnabled: true,
		bevelThickness: 10,
		bevelSize: 8,
		bevelOffset: 0,
		bevelSegments: 5
	} );
} );*/

}

					function animate() {

								requestAnimationFrame( animate );
								const delta = clock.getDelta();
								controls.update( delta );
								renderer.render( scene, camera );

					}

		</script>

	</body>
</html>
