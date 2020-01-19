<?php


use Phinx\Migration\AbstractMigration;

class InitialSchema extends AbstractMigration
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
		$isUpgrade = $this->hasTable('frontpage');
		
		if (!$isUpgrade)
		{
			$this->CreateMainTables();
		} else
	    {
		    $this->UpgradeTables();
		    $this->UpgradeFiles();
	    }

	    $this->CreateNewTables();
    }
	
	public function CreateMainTables()
	{
		// GALLERY
		$table = $this->table('gallery', [
			'primary_key' => 'id',
			'id' => true
		]);
		$table->addColumn('name', 'string', ['limit' => 255, 'default' => '', 'null' => false])
			->addColumn('description', 'text', ['null' => true, 'default' => null])
			->addColumn('parent_id', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addColumn('use_tags', 'integer', ['default' => 1, 'null' => false])
			->addColumn('combined_view', 'integer', ['default' => 1, 'null' => false])
			->create();
		
		// IMAGE
		$table = $this->table('image', [
			'primary_key' => 'id',
			'id' => true
		]);
		$table->addColumn('filename', 'string', ['limit' => 255, 'default' => '', 'null' => false])
			->addColumn('description', 'text', ['null' => true])
			->addColumn('width', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addColumn('height', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addColumn('format', 'string', ['limit' => 10, 'default' => '', 'null' => false])
			->create();
		
		// GALLERYTAGLINK
		$table = $this->table('gallerytaglink', [
			'primary_key' => 'id',
			'id' => true
		]);
		$table->addColumn('gallery_id', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addColumn('tag_id', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addIndex('gallery_id')
			->addIndex('tag_id')
			->create();
		
		// IMAGETAGLINK
		$table = $this->table('imagetaglink', [
			'primary_key' => 'id',
			'id' => true
		]);
		$table->addColumn('image_id', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addColumn('tag_id', 'integer', ['signed' => false, 'default' => 0, 'null' => false])
			->addIndex('image_id')
			->addIndex('tag_id')
			->create();
		
		// TAG
		$table = $this->table('tag', [
			'id' => true,
			'primary_key' => 'id'
		]);
		$table->addColumn('name', 'string', ['limit' => 100, 'default' => '', 'null' => false])
			->create();
	}
    
    protected function UpgradeTables()
    {
    	$this->dropTable('frontpage');
    	
    	$table = $this->table('gallery');
    	$table->renameColumn('IDGallery', 'id');
	    $table->renameColumn('Name', 'name');
	    $table->renameColumn('Description', 'description');
	    $table->renameColumn('IDParent', 'parent_id');
	    $table->renameColumn('UseTags', 'use_tags');
	    $table->addColumn('combined_view', 'integer', ['default' => 0, 'null' => false]);
    	$table->update();
	
	    $table = $this->table('image');
	    $table->renameColumn('IDImage', 'id');
	    $table->renameColumn('Filename', 'filename');
	    $table->renameColumn('Description', 'description');
	    $table->renameColumn('Width', 'width');
	    $table->renameColumn('Height', 'height');
	    $table->renameColumn('Format', 'format');
	    $table->update();
	
	    $table = $this->table('gallerytaglink');
	    $table->renameColumn('IDGalleryTagLink', 'id');
	    $table->renameColumn('IDGallery', 'gallery_id');
	    $table->renameColumn('IDTag', 'tag_id');
	    $table->update();
	
	    $table = $this->table('imagetaglink');
	    $table->renameColumn('IDImageTagLink', 'id');
	    $table->renameColumn('IDImage', 'image_id');
	    $table->renameColumn('IDTag', 'tag_id');
	    $table->update();
	
	    $table = $this->table('tag');
	    $table->renameColumn('IDTag', 'id');
	    $table->renameColumn('Name', 'name');
	    $table->update();
    }
	
	protected function CreateNewTables()
	{
		// GALLERYTHUMB
		$table = $this->table('gallerythumb', [
			'id' => false
		]);
		$table->addColumn('gallery_id', 'integer', ['null' => false])
			->addColumn('image_id', 'integer', ['null' => false])
			->addColumn('auto', 'integer', ['null' => false, 'default' => 1])
			->create();
		
		// INCOMING
		$table = $this->table('incoming', [
			'id' => true,
			'primary_key' => 'id'
		]);
		$table->addColumn('filename', 'string', ['limit' => 255, 'default' => '', 'null' => false])
			->addColumn('timestamp', 'integer', ['default' => 0, 'null' => false])
			->addColumn('hash', 'string', ['limit' => 40, 'default' => '', 'null' => false])
			->addColumn('extension', 'string', ['limit' => 10, 'default' => '', 'null' => false])
			->create();
		
		// THUMB_REGEN
		$table = $this->table('thumb_regen', [
			'id' => true,
			'primary_key' => 'id'
		]);
		$table->addColumn('image_id', 'integer', ['default' => 0, 'null' => false])
			->create();
	}
	
	protected function UpgradeFiles()
	{
		$source_path = '../../images/';
		$dest_path = '../../data/images/';
		
		if (!file_exists($source_path))
			return;
		
		foreach (glob($source_path . '/*.jpg') as $file)
		{
			$filename = substr($file, strlen($source_path) + 1);
			$id = (int)substr($filename, 0, 10);
			rename($file, $dest_path . $id . '.jpg');
		}
		
		if (file_exists($source_path . 'thumbs'))
		{
			foreach (glob($source_path . 'thumbs/*') as $file)
			{
				unlink($file);
			}
		}
		
		foreach (glob($source_path . '*') as $file)
		{
			unlink($file);
		}
		rmdir($source_path . 'thumbs');
		rmdir($source_path);
	}
}

