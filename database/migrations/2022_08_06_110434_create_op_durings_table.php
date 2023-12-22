<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpDuringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('op_durings', function (Blueprint $table) {
            $table->id();
            $table->integer('op_id');
            $table->integer('patient_id');
            $table->boolean('dorsum_hump_reduction_bony')->nullable();
            $table->boolean('dorsum_hump_reduction_septal')->nullable();
            $table->boolean('dorsum_hump_reduction_cartilaginous')->nullable();
            $table->boolean('dorsum_augmentation')->nullable();
            $table->boolean('dorsum_caudal_resection')->nullable();
            $table->boolean('septum_excision_except')->nullable();
            $table->boolean('septum_total_excision_reconstruction')->nullable();
            $table->boolean('septum_reconstruction')->nullable();
            $table->boolean('septum_fixation_spine')->nullable();
            $table->boolean('septum_fixation_nasal_bones')->nullable();
            $table->boolean('septum_scoring')->nullable();
            $table->boolean('osteotomies_med_oblique')->nullable();
            $table->boolean('osteotomies_lateral')->nullable();
            $table->boolean('osteotomies_multiple')->nullable();
            $table->boolean('osteotomies_bone_carving')->nullable();
            $table->boolean('upper_lats_on_lay_grafts')->nullable();
            $table->boolean('upper_lats_total_reconstruction')->nullable();
            $table->boolean('upper_lats_spreader_grafts')->nullable();
            $table->boolean('upper_lats_spreader_flaps')->nullable();
            $table->boolean('tip_plasty_hemidomal_suture')->nullable();
            $table->boolean('tip_plasty_tip_defining_suture')->nullable();
            $table->boolean('tip_plasty_tip_equalizing_suture')->nullable();
            $table->boolean('tip_plasty_other_sutures')->nullable();
            $table->boolean('cap_graft_non_crushed_cartilage')->nullable();
            $table->boolean('cap_graft_crushed_cartilage')->nullable();
            $table->boolean('cap_graft_soft_tissue_cartilage')->nullable();
            $table->boolean('tip_plasty_shield_graft')->nullable();
            $table->boolean('tip_plasty_columellar_strut')->nullable();
            $table->boolean('tools_rose_head_drill')->nullable();
            $table->boolean('tools_burr_head_drill')->nullable();
            $table->boolean('tools_piezotome')->nullable();
            $table->boolean('tools_hammer_chisel')->nullable();
            $table->boolean('dorsal_graft')->nullable();
            $table->boolean('conceal_cartilage_graft')->nullable();
            $table->boolean('costal_cartilage_graft')->nullable();
            $table->boolean('temporal_fascial_graft')->nullable();
            $table->string('op_type', 40)->nullable();
            $table->boolean('tools_raspier')->nullable();
            $table->boolean('nostril_reduction')->nullable();
            $table->string('other_steps', 255)->nullable();
            $table->string('other_operations', 255)->nullable();
            $table->boolean('cephalic_resection_lat_crus_cartilage')->nullable();
            $table->string('op_duration', 20)->nullable();
            $table->string('skin_type', 20)->nullable();
            $table->string('other_facial_problems', 150)->nullable();
            $table->string('length', 10)->nullable();
            $table->string('dorsal_width', 10)->nullable();
            $table->string('rotation', 10)->nullable();
            $table->string('tip_projection', 10)->nullable();
            $table->string('alar_base', 10)->nullable();
            $table->string('other_note', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('op_durings');
    }
}