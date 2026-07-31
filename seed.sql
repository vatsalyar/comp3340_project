-- Author: Vatsalya Rastogi (110147846)
-- Course: COMP3340
-- Description: DML queries to populate the initial product catalog and admin accounts.

-- Seed data for COMP3340 Civic Parts Depot.
-- Modified for shared hosting (removed USE statement)

INSERT INTO users (username, email, password_hash, role, is_disabled) VALUES
('admin', 'admin@example.com', '$2y$10$Js4Q9ALpxu5Y6ROPbNO7vOFx16Y3.A.nvBiX0aEQkg0Qfht6bomJ6', 'admin', 0);
-- Password for above hash: admin123

INSERT INTO products (sku, category, name, compatibility, image_path) VALUES
('SKU-001','Maintenance','Engine Air Filter','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-001.svg'),
('SKU-002','Maintenance','Cabin Air Filter','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-002.svg'),
('SKU-003','Maintenance','Front Brake Pads','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-003.svg'),
('SKU-004','Maintenance','Rear Brake Pads','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-004.svg'),
('SKU-005','Maintenance','Spark Plug Set (4pc)','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-005.svg'),
('SKU-006','Aero & Body','Duckbill Trunk Spoiler','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-006.svg'),
('SKU-007','Aero & Body','Front Lip Kit','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-007.svg'),
('SKU-008','Aero & Body','Side Skirt Pair','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-008.svg'),
('SKU-009','Aero & Body','Smoked LED Tail Lights','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-009.svg'),
('SKU-010','Aero & Body','Honeycomb Front Grille','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-010.svg'),
('SKU-011','Wheel & Tire','17in Alloy Wheel (Single)','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-011.svg'),
('SKU-012','Wheel & Tire','Performance Tire 225/45R17 (Single)','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-012.svg'),
('SKU-013','Wheel & Tire','Wheel Spacer Set','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-013.svg'),
('SKU-014','Wheel & Tire','Lug Nut Kit','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-014.svg'),
('SKU-015','Wheel & Tire','TPMS Sensor (Single)','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-015.svg'),
('SKU-016','Interior','Weighted Shift Knob','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-016.svg'),
('SKU-017','Interior','All-Weather Floor Mats','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-017.svg'),
('SKU-018','Interior','LED Dome Light Kit','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-018.svg'),
('SKU-019','Interior','Steering Wheel Cover','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-019.svg'),
('SKU-020','Interior','Pedal Cover Set','2008 Honda Civic EX-L 2dr Coupe','assets/images/SKU-020.svg');

INSERT INTO product_options (product_id, option_type, price)
SELECT id, 'Standard', 10.00 + id FROM products;

INSERT INTO product_options (product_id, option_type, price)
SELECT id, 'Premium', 20.00 + id FROM products;