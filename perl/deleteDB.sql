USE moatest;

DROP VIEW IF EXISTS `moatest_v_gallery_images`;
DROP VIEW IF EXISTS `moatest_v_orphan_images`;
DROP VIEW IF EXISTS `moatest_v_orphan_no_gallery`;
DROP VIEW IF EXISTS `moatest_v_orphan_no_tags`;

DROP TABLE IF EXISTS `moatest_imagetaglink`;
DROP TABLE IF EXISTS `moatest_gallerytaglink`;

DROP TABLE IF EXISTS `moatest_frontpage`;
DROP TABLE IF EXISTS `moatest_gallery`;
DROP TABLE IF EXISTS `moatest_galleryindex`;
DROP TABLE IF EXISTS `moatest_image`;
DROP TABLE IF EXISTS `moatest_settings`;
DROP TABLE IF EXISTS `moatest_tag`;
DROP TABLE IF EXISTS `moatest_users`;
