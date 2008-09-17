CREATE OR REPLACE VIEW <prefix>v_gallery_images AS                               
select gg.IDGallery                                                          
     , itl.IDImage                                                           
     , img.Description                                                       
  from <prefix>imagetaglink itl,                                                 
       <prefix>gallerytaglink gtl,                                               
       <prefix>image img,                                                        
       <prefix>gallery gg                                                        
 where itl.IDTag = gtl.IDTag and                                             
       itl.IDImage = img.IDImage                                             
   and gtl.IDGallery = gg.IDGallery                                          
 group by gg.IDGallery, itl.IDimage, img.Description                         
having count(itl.IDTag) = (select count(gtl.IDTag)                           
                             from <prefix>gallerytaglink gtl                     
                            where gtl.IDGallery = gg.IDGallery);

CREATE OR REPLACE VIEW <prefix>v_orphan_images AS
select img.IDImage
     , img.Description
     , img.Filename
     , img.Height
     , img.Width
  from  <prefix>image img
 where img.IDImage NOT IN (select gvgi.IDImage
                             from <prefix>v_gallery_images gvgi);

CREATE OR REPLACE VIEW <prefix>v_orphan_no_tags AS
SELECT <prefix>image.*
FROM <prefix>image LEFT JOIN <prefix>imagetaglink ON <prefix>image.IDImage=<prefix>imagetaglink.IDImage
GROUP BY <prefix>image.IDImage
HAVING (((Count(<prefix>imagetaglink.IDTag))=0));

CREATE OR REPLACE VIEW <prefix>v_orphan_no_gallery AS
SELECT <prefix>v_orphan_images.*
FROM <prefix>v_orphan_images LEFT JOIN <prefix>v_orphan_no_tags ON <prefix>v_orphan_images.IDImage = <prefix>v_orphan_no_tags.IDImage
GROUP BY <prefix>v_orphan_images.IDImage
HAVING (((Count(<prefix>v_orphan_no_tags.IDImage))=0));


