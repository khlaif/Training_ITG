<style>
    .player-page {
        width: 90%;
        max-width: 1050px;
        margin: 45px auto;
    }

    .player-page h1,
    .player-page h2,
    .player-page h3 {
        color: #1e3a5f;
    }

    .page-heading {
        margin-bottom: 25px;
    }

    .page-heading h1 {
        margin-bottom: 8px;
    }

    .page-heading p {
        color: #777;
    }

    .player-card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 9px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
    }

    .player-card h2 {
        margin-top: 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .stat-number {
        font-size: 38px;
        font-weight: bold;
        color: #1e3a5f;
        margin: 10px 0;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-row strong {
        color: #1e3a5f;
    }

    .detail-row span {
        text-align: right;
        overflow-wrap: anywhere;
    }

    .player-btn {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 5px;
        background: #1e3a5f;
        color: white;
        text-decoration: none;
        font-size: 14px;
    }

    .player-btn:hover {
        background: #152c4b;
        color: white;
    }

    .secondary-btn {
        background: #e5e7eb;
        color: #333;
    }

    .secondary-btn:hover {
        background: #d1d5db;
        color: #222;
    }

    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 20px;
    }

    .player-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .player-table th,
    .player-table td {
        text-align: left;
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: top;
    }

    .player-table th {
        background: #eaf0f6;
        color: #1e3a5f;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .empty-message {
        color: #777;
        padding: 18px 0;
    }

    /* Task 7 - Player Profile Images */

    .profile-image-section {
        text-align: center;
        padding: 25px 15px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #e5e7eb;
        display: block;
        margin: 0 auto 15px;
    }

    .profile-image-section h2 {
        margin-bottom: 8px;
    }

    .profile-image-hint {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .profile-upload-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .profile-upload-form input[type="file"] {
        max-width: 100%;
        padding: 10px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
    }

    .remove-image-btn {
        background: #dc2626;
        border: none;
        cursor: pointer;
    }

    .remove-image-btn:hover {
        background: #b91c1c;
    }

    .dashboard-profile-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .dashboard-profile-header h2 {
        margin: 0;
    }

    .dashboard-avatar {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e5e7eb;
    }

    .profile-alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .success-alert {
        background: #dcfce7;
        color: #166534;
    }

    .error-alert {
        background: #fee2e2;
        color: #991b1b;
    }

    .error-alert p {
        margin: 5px 0;
    }

    /* Task 7 - Custom Profile Image Upload */

    .custom-file-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .hidden-file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        overflow: hidden;
    }

    .custom-upload-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;

        background: #f1f5f9;
        color: #1e3a5f;

        border: 2px dashed #94a3b8;
        border-radius: 12px;

        padding: 14px 24px;
        font-size: 15px;
        font-weight: 600;

        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-upload-btn:hover {
        background: #e2e8f0;
        border-color: #1e3a5f;
        transform: translateY(-2px);
    }

    .hidden-file-input:focus-visible+.custom-upload-btn {
        outline: 3px solid #2563eb;
        outline-offset: 3px;
    }

    .upload-icon {
        font-size: 22px;
    }

    .selected-file-name {
        font-size: 13px;
        color: #64748b;
        margin: 0;
        text-align: center;
        overflow-wrap: anywhere;
    }

    @media (max-width: 650px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .player-card {
            padding: 20px;
        }

        .detail-row {
            flex-direction: column;
            gap: 5px;
        }

        .detail-row span {
            text-align: left;
        }
    }
</style>