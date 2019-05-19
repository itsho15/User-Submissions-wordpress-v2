<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmssionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('submissions', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->enum('type', ['journal', 'event', 'training', 'reports']);

			$table->string('journal_author')->nullable();
			$table->string('journal_organization')->nullable();
			$table->string('journal_authors')->nullable();
			$table->date('journal_issued_date')->nullable();
			$table->string('journal_title')->nullable();
			$table->string('journal_abstract')->nullable();
			$table->string('journal_name')->nullable();
			$table->string('journal_website')->nullable();
			$table->string('journal_keywords')->nullable();

			$table->string('event_organizer')->nullable();
			$table->string('event_sponsor')->nullable();
			$table->string('event_title')->nullable();
			$table->date('event_start_date')->nullable();
			$table->string('event_duration')->nullable();
			$table->text('event_summary_type')->nullable();
			$table->text('event_audience_target')->nullable();
			$table->integer('event_related_report')->default(0)->nullable();
			$table->string('event_report_author')->nullable();
			$table->string('event_report_organization')->nullable();
			$table->string('event_report_title')->nullable();
			$table->string('event_report_abstract')->nullable();
			$table->string('event_website')->nullable();
			$table->string('event_keywords')->nullable();

			$table->string('training_organizer')->nullable();
			$table->string('training_title')->nullable();
			$table->string('training_provider')->nullable();
			$table->string('training_fee')->nullable();
			$table->enum('training_type', ['invitation', 'public'])->nullable();
			$table->string('training_duration')->nullable();
			$table->text('training_description')->nullable();
			$table->string('training_issued_date')->nullable();
			$table->string('training_website')->nullable();
			$table->string('training_keywords')->nullable();

			$table->string('report_organization')->nullable();
			$table->string('report_title')->nullable();
			$table->date('yearofrelease')->nullable();
			$table->string('report_authors')->nullable();
			$table->string('report_abstract')->nullable();
			$table->string('stateplan')->nullable();
			$table->string('yearterm')->nullable();
			$table->string('report_keywords')->nullable();
			$table->string('image_cover')->nullable();

			$table->integer('Approval')->nullable();
			$table->integer('approved_by')->unsigned()->nullable();
			$table->text('reason_approve')->nullable();

			$table->integer('user_id')->unsigned()->nullable();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('submissions');
	}
}
