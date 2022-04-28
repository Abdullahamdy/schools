<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade');
		});

        Schema::table('sections', function(Blueprint $table) {
            $table->foreign('Grade_id')->references('id')->on('Grades')
                ->onDelete('cascade');
        });



            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Nationality_Father_id')->references('id')->on('nationalties')
                    ->onDelete('cascade');
            });
            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Blood_Type_Father_id')->references('id')->on('blood__types')
                    ->onDelete('cascade');
            });
            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Religion_Father_id')->references('id')->on('religions')
                    ->onDelete('cascade');
            });

            //mother
            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Nationality_Mother_id')->references('id')->on('nationalties')
                    ->onDelete('cascade');
            });
            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Blood_Type_Mother_id')->references('id')->on('blood__types')
                    ->onDelete('cascade');
            });
            Schema::table('my_parents', function(Blueprint $table) {
                $table->foreign('Religion_Mother_id')->references('id')->on('religions')
                    ->onDelete('cascade');
            });
            Schema::table('parent_attachments', function(Blueprint $table) {
                $table->foreign('parent_id')->references('id')->on('my_parents')
                    ->onDelete('cascade');
            });

	}

	public function down()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->dropForeign('Classrooms_Grade_id_foreign');
		});
        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_Grade_id_foreign');
        });
        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('sections_Class_id_foreign');
        });
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Nationality_Father_id_foreign');
        // });
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Blood_Type_Father_id_foreign');
        // });
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Religion_Father_id_foreign');
        // });
        // //mother
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Nationality_Mother_id_foreign');
        // });
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Blood_Type_Mother_id_foreign');
        // });
        // Schema::table('my_parents', function(Blueprint $table) {
        //     $table->dropForeign('my_parents_Religion_Mother_id_foreign');
        // });

	}
}
