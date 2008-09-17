ALTER TABLE `<prefix>gallerytaglink`
  DROP FOREIGN KEY `<prefix>gallerytaglink_ibfk_1`,
  DROP FOREIGN KEY `<prefix>gallerytaglink_ibfk_2`;

ALTER TABLE `<prefix>imagetaglink`
  DROP FOREIGN KEY `<prefix>imagetaglink_ibfk_1`,
  DROP FOREIGN KEY `<prefix>imagetaglink_ibfk_2`;