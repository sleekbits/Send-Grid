<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table): void {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('tag')->nullable();
            $table->string('status')->default('active');
            $table->string('source')->nullable();
            $table->string('country', 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('consent_at')->nullable();
            $table->timestamp('double_opt_in_at')->nullable();
            $table->timestamps();
        });

        Schema::create('email_templates', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('subject');
            $table->longText('html_body');
            $table->json('json_schema')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('segments', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->json('filters');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('smtp_profiles', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('driver')->default('smtp');
            $table->string('host');
            $table->unsignedSmallInteger('port');
            $table->string('username');
            $table->text('password_encrypted');
            $table->string('encryption')->nullable();
            $table->string('from_email');
            $table->string('from_name');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::create('campaigns', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('reply_to_email')->nullable();
            $table->string('type')->default('regular');
            $table->string('status')->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->foreignId('email_template_id')->nullable()->constrained('email_templates')->nullOnDelete();
            $table->foreignId('segment_id')->nullable()->constrained('segments')->nullOnDelete();
            $table->foreignId('smtp_profile_id')->nullable()->constrained('smtp_profiles')->nullOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('total_recipients')->default(0);
            $table->unsignedInteger('sent_count')->default(0);
            $table->unsignedInteger('delivered_count')->default(0);
            $table->unsignedInteger('failed_count')->default(0);
            $table->unsignedInteger('open_count')->default(0);
            $table->unsignedInteger('click_count')->default(0);
            $table->timestamps();
        });

        Schema::create('email_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->cascadeOnDelete();
            $table->foreignId('contact_id')->constrained('contacts')->cascadeOnDelete();
            $table->string('provider');
            $table->string('message_id')->nullable();
            $table->string('status')->default('queued');
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamp('bounced_at')->nullable();
            $table->text('failure_reason')->nullable();
            $table->timestamps();
            $table->unique(['campaign_id', 'contact_id']);
        });

        Schema::create('system_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('group');
            $table->string('key');
            $table->longText('value')->nullable();
            $table->timestamps();
            $table->unique(['group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('email_logs');
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('smtp_profiles');
        Schema::dropIfExists('segments');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('contacts');
    }
};
