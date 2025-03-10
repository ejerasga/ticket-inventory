<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        CREATE TABLE tickets (
            t_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,      -- Primary key t_id
            t_control_no VARCHAR(255) NOT NULL,                    -- control number for the ticket
            s_id BIGINT UNSIGNED NOT NULL,                         -- foreign key to services
            req_by BIGINT UNSIGNED NOT NULL,                       -- foreign key to users table (user who requested it)
            f_name VARCHAR(255) NOT NULL,                          -- first name
            l_name VARCHAR(255) NOT NULL,                          -- last name
            d_id BIGINT UNSIGNED NOT NULL,                         -- foreign key to departments
            received_by BIGINT UNSIGNED NOT NULL,                  -- foreign key (received by user)
            located_at BIGINT UNSIGNED NOT NULL,                   -- foreign key (location)
            description TEXT,                                      -- description of the ticket
            date_requested TIMESTAMP NOT NULL,                     -- timestamp for when it was requested
            date_needed TIMESTAMP NOT NULL,                        -- timestamp for when it is needed
            time_needed TIME NOT NULL,                             -- time when needed
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,        -- created_at timestamp
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- updated_at timestamp
            -- Foreign key constraints
            FOREIGN KEY (req_by) REFERENCES users(u_id) ON DELETE CASCADE,
            FOREIGN KEY (s_id) REFERENCES services(s_id) ON DELETE CASCADE,
            FOREIGN KEY (d_id) REFERENCES departments(d_id) ON DELETE CASCADE,
            FOREIGN KEY (received_by) REFERENCES users(u_id) ON DELETE CASCADE,
            FOREIGN KEY (located_at) REFERENCES locations(l_id) ON DELETE CASCADE
        );
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
