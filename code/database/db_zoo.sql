CREATE DATABASE db_zoo;
USE db_zoo;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
);

CREATE TABLE animals (
  id INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  scientific_name VARCHAR(255) NOT NULL,
  `desc` TEXT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY(category_id) REFERENCES categories(id)
);

CREATE TABLE enclosures (
  id INT AUTO_INCREMENT PRIMARY KEY,
  `size` INT DEFAULT(0),
  water_level ENUM('none', 'ground', 'submerged') NULL DEFAULT('none'),
  water_type ENUM('none', 'salt-water', 'fresh-water', 'brackish-water') NULL DEFAULT('none'),
  sun_exposure ENUM('low', 'moderate', 'high') NULL,
  vegetation ENUM('low', 'moderate', 'high') NULL,
  `security` ENUM('low', 'moderate', 'high') NULL,
  is_indoor BOOLEAN  DEFAULT(1),
  `status` ENUM('empty', 'closed', 'under maintenance', 'public') NOT NULL DEFAULT('empty'),
  last_maintained_at DATE NULL
);

CREATE TABLE enclosure_animals (
  enclosure_id INT NOT NULL,
  animal_id INT NOT NULL,
  `number` INT NOT NULL DEFAULT(0),
  FOREIGN KEY(enclosure_id) REFERENCES enclosures(id),
  FOREIGN KEY(animal_id) REFERENCES animals(id)
);


INSERT INTO categories(id, `name`) VALUES
  (1, 'Mammal'),
  (2, 'Reptile'),
  (3, 'Insect'),
  (4, 'Bird'),
  (5, 'Amphibian'),
  (6, 'Marine'),
  (7, 'Fresh-water'),
  (8, 'Brackish-water');

INSERT INTO animals(id, `name`, scientific_name, `desc`, category_id) VALUES
  -- Category 1: Mammal (2? animals)
  (1, 'Woolly Mammoth', 'Mammuthus Primigenius', 'This species has long since being ext—wait, what? How is this here?', 1),
  (2, 'African Lion', 'Panthera leo', 'Large carnivorous feline native to African grasslands.', 1),
  (3, 'African Bush Elephant', 'Loxodonta africana', 'The largest living land animal, recognized by its massive ears and trunk.', 1),

  -- Category 2: Reptile (2 animals)
  (4, 'Komodo Dragon', 'Varanus komodoensis', 'The largest living species of lizard, native to Indonesian islands.', 2),
  (5, 'Reticulated Python', 'Malayopython reticulatus', 'An Asiatic snake species noted as the world longest snake.', 2),

  -- Category 3: Insect (3? animals)
  (6, 'Monarch Butterfly', 'Danaus plexippus', 'Famous milkweed butterfly known for its massive multi-generational migrations.', 3),
  (7, 'Hercules Beetle', 'Dynastes hercules', 'The most famous and largest of all rhinoceros beetle species.', 3),
  (8, 'Common Green Darner', 'Anax junius', 'A large and prominent species of migratory dragonfly.', 3),
  (9, 'Meganeura Monyi', 'Meganeura Monyi', 'How in the actual f—', 3),

  -- Category 4: Bird (2 animals)
  (10, 'Bald Eagle', 'Haliaeetus leucocephalus', 'A large bird of prey and the national bird of the United States.', 4),
  (11, 'Emperor Penguin', 'Aptenodytes forsteri', 'The tallest and heaviest of all living penguin species, endemic to Antarctica.', 4),

  -- Category 5: Amphibian (2 animals)
  (12, 'Axolotl', 'Ambystoma mexicanum', 'Neotenic salamander famous for its extraordinary regenerative capabilities.', 5),
  (13, 'Red-Eyed Tree Frog', 'Agalychnis callidryas', 'Arboreal amphibian recognizable by its vibrant red eyes and neon-green skin.', 5),

  -- Category 6: Marine (3 animals)
  (14, 'Palette Surgeonfish', 'Paracanthurus Hepatus', 'Vibrant marine fish that can be found throughout the Indo-Pacific.', 6),
  (15, 'Clownfish', 'Amphiprion Ocellaris', 'Popular tropical fish, known to form a symbiotic relationship with anemones.', 6),
  (16, 'Green Sea Turtle', 'Chelonia mydas', 'Large sea turtle distributed throughout tropical and subtropical oceans.', 6),

  -- Category 7: Fresh-water (3 animals)
  (17, 'Red-bellied Piranha', 'Pygocentrus nattereri', 'Freshwater fish native to South America, known for its strong jaws and sharp teeth.', 7),
  (18, 'Largemouth Bass', 'Micropterus salmoides', 'Popular freshwater game fish native to North America.', 7),
  (19, 'Electric Eel', 'Electrophorus electricus', 'Freshwater fish capable of generating powerful electric shocks for hunting and defense.', 7),

  -- Category 8: Brackish-water (3 animals)
  (20, 'Atlantic Mudskipper', 'Periophthalmus barbarus', 'Amphibious fish that spends considerable time out of water using specialized pectoral fins.', 8),
  (21, 'Banded Archerfish', 'Toxotes jaculatrix', 'Fish famous for its ability to shoot down aerial insect prey using forced water droplets.', 8),
  (22, 'Barramundi', 'Lates calcarifer', 'Large catadromous fish found in coastal waters, estuaries, and river mouths.', 8);

INSERT INTO enclosures(id, `size`, water_level, water_type, sun_exposure, vegetation, `security`, is_indoor, `status`, last_maintained_at) VALUES
  (99, 0, 'none', 'none', 'low', 'low', 'low', 1, 'closed', '0001-01-01'),
  (1, 220, 'none', 'none', 'high', 'moderate', 'low', 0, 'public', NULL),
  (2, 180, 'none', 'none', 'high', 'moderate', 'high', 0, 'public', NULL),
  (3, 200, 'none', 'none', 'high', 'moderate', 'high', 0, 'public', NULL),
  (4, 35, 'none', 'none', 'low', 'low', 'moderate', 1, 'public', NULL),
  (5, 16, 'none', 'none', 'moderate', 'high', 'low', 1, 'public', NULL),
  (6, 20, 'ground', 'fresh-water', 'moderate', 'high', 'low', 1, 'public', NULL),
  (7, 24, 'none', 'none', 'moderate', 'moderate', 'moderate', 1, 'public', NULL),
  (8, 48, 'ground', 'salt-water', 'low', 'low', 'moderate', 1, 'public', NULL),
  (9, 105, 'submerged', 'salt-water', 'low', 'moderate', 'low', 1, 'public', NULL),
  (10, 20, 'submerged', 'fresh-water', 'low', 'moderate', 'moderate', 1, 'public', NULL),
  (11, 70, 'submerged', 'fresh-water', 'low', 'moderate', 'low', 1, 'public', NULL),
  (12, 25, 'ground', 'brackish-water', 'high', 'high', 'low', 0, 'public', NULL);

INSERT INTO enclosure_animals(enclosure_id, animal_id, `number`) VALUES
  (99, 1, 1),
  (99, 9, 1),
  (1, 3, 7),
  (2, 2, 15),
  (3, 4, 6),
  (4, 5, 4),
  (5, 6, 19),
  (5, 7, 14),
  (6, 8, 10),
  (6, 12, 8),
  (6, 13, 9),
  (7, 10, 5),
  (8, 11, 12),
  (9, 14, 19),
  (9, 15, 23),
  (9, 16, 8),
  (10, 17, 17),
  (11, 18, 5),
  (11, 19, 7),
  (12, 20, 25),
  (12, 21, 18),
  (12, 22, 12);