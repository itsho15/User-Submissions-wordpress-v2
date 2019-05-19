<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model {

	/** Model Settings **/
	protected $table      = 'documents';
	protected $primaryKey = 'id';
	protected $fillable   = ['name', 'submission_id'];

	public $timestamps = false;
	/** Appendable Attributes **/

	public function store() {

		if (!empty($_FILES) && isset($_FILES['event_report_abstract'])) {

			$file = wp_upload_bits($_FILES['event_report_abstract']['name'], null, @file_get_contents($_FILES['event_report_abstract']['tmp_name']));

			if (FALSE === $file['error']) {

				$document_table_name = $wpdb->prefix . 'documents';

				$insertDoc = $wpdb->insert($document_table_name, [
					'name'          => $file['url'],
					'submission_id' => $id,
				]);

				if ($insertDoc > 0) {
					self::$message = $this->messages('Docs Inserted', 'updated');

				}
			}

		}
	}

}