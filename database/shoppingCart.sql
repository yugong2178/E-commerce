CREATE DATABASE qs_product CHARACTER SET utf8 COLLATE utf8_general_ci;

USE qs_product;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `price`double NOT NULL,
  `img` varchar(60) NOT NULL,
 
  PRIMARY KEY (`id`)
  )AUTO_INCREMENT=1 ;

INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('1', 'Air Jordan 1 Low Shoes', '489', 'Nike1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('2', 'AL8 Shoes', '395', 'Nike2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('3', 'Supernova Rise Shoes', '599', 'Adidas1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('4', 'Rivalry Low Shoes Kids', '319', 'Adidas2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('5', 'NY 90 Shoes', '233.10', 'Adidas3.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('6', 'Ultra Stretch AIRism Cropped Short Sleeve T-Shirt', '59.90', 'Uniqlo1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('7', 'V Neck Long Sleeve Cardigan', '129.90', 'Uniqlo4.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('8', 'Wide Straight Jeans', '149.90', 'Uniqlo2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('9', 'Wide Fit Parachute Cargo Pants', '129.90', 'Uniqlo3.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('10', 'Printed T-shirt', '22.95', 'H&H1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('11', 'Loose Fit roll-up trousers', '54.95', 'H&H2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('12', 'Printed jersey top', '22.95', 'H&H3.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('13', 'Wide Leg paper bag jeans', '74.95', 'H&H4.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('14', 'ASUS Vivobook 14 (A1405Z-ALY235WS)', '2499', 'Asus1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('15', 'ROG Zephyrus G16 (GU605M-VQR193WO)', '9999', 'Asus2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('16', 'Galaxy S23 Ultra', '4999', 'Samsung1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('17', 'Galaxy A55 5G', '1999', 'Samsung2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('18', '85" X80L | 4K Ultra HD | High Dynamic Range (HDR) | Smart TV (Google TV)', '8599', 'Sony1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('19', 'ZV-E1 full-frame vlog camera', '11999', 'Sony2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('20', 'X-Premium Inverter XU Series (XKH-1)', '2591', 'Panasonic1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('21', 'PRIME+ Edition NR-CW530XMMM', '5899', 'Panasonic2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('22', 'SANDSBERG / ADDE, Table and 4 chairs, black/black, 110x67 cm', '375', 'Ikea1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('23', 'BRIMNES, Dressing table, white, 70x42 cm', '299', 'Ikea2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('24', 'Flos Gustave Hospitality Table Lamp', '2274.96', 'Space1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('25', 'Kartell Pop Outdoor 2 Seat Sofa - Sunbrella Fabric', '32182.90', 'Space2.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('26', 'Distrikt Bed', '16500', 'UrbanEdge1.png');
INSERT INTO `products` (`id`, `name`, `price`, `img`) VALUES ('27', 'Tote Dresser', '18800', 'UrbanEdge2.png');

