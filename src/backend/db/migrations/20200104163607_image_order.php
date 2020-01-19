<?php


use Phinx\Migration\AbstractMigration;

class ImageOrder extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
	    // IMAGE_ORDER
	    $table = $this->table('image_order', []);
	    $table->addColumn('gallery_id', 'integer', ['default' => null, 'null' => true])
		    ->addColumn('image_id', 'integer', ['default' => null, 'null' => true])
		    ->addColumn('order', 'integer', ['default' => null, 'null' => true])
		    ->addIndex(['gallery_id', 'order'], [
		    	'name' => 'idx_image_order'
		    ])
		    ->create();
	    
	    // If no old data to upgrade, can stop here
	    if (!$this->hasTable('galleryindex'))
		    return;
	    
	    $this->query('INSERT INTO image_order (gallery_id, image_id, `order`) (SELECT IDGallery, IDImage, Seq FROM galleryindex)');
    }
}
