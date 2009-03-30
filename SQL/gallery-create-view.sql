CREATE OR REPLACE VIEW <prefix>v_gallery_images AS
SELECT Gal.IDGallery
     , ImgTagLinks.IDImage
     , Img.Description
  FROM <prefix>imagetaglink   AS ImgTagLinks,
       <prefix>gallerytaglink AS GalTagLinks,
       <prefix>image          AS Img,
       <prefix>gallery        AS Gal
 WHERE ImgTagLinks.IDTag     = GalTagLinks.IDTag
   AND ImgTagLinks.IDImage   = Img.IDImage
   AND GalTagLinks.IDGallery = Gal.IDGallery
 GROUP BY Gal.IDGallery, ImgTagLinks.IDimage, Img.Description
HAVING COUNT(ImgTagLinks.IDTag) = (SELECT COUNT(GalTagLinks2.IDTag)
                                     FROM <prefix>gallerytaglink AS GalTagLinks2
                                    WHERE GalTagLinks2.IDGallery = Gal.IDGallery);

CREATE OR REPLACE VIEW <prefix>v_orphan_images AS
SELECT Img.IDImage
     , Img.Description
     , Img.Filename
     , Img.Height
     , Img.Width
  FROM <prefix>image AS Img
 WHERE Img.IDImage NOT IN (SELECT GalImages.IDImage
                             FROM <prefix>v_gallery_images GalImages);

CREATE OR REPLACE VIEW <prefix>v_orphan_no_tags AS
SELECT Img.*
  FROM <prefix>image AS Img LEFT JOIN <prefix>imagetaglink As ImgTagLinks ON Img.IDImage = ImgTagLinks.IDImage
 GROUP BY Img.IDImage
HAVING (((COUNT(ImgTagLinks.IDTag))=0));

CREATE OR REPLACE VIEW <prefix>v_orphan_no_gallery AS
SELECT OrphanImgs.*
  FROM <prefix>v_orphan_images AS OrphanImgs LEFT JOIN <prefix>v_orphan_no_tags AS Notags ON OrphanImgs.IDImage = NoTags.IDImage
 GROUP BY OrphanImgs.IDImage
HAVING (((COUNT(NoTags.IDImage))=0));
