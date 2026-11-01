<style>
    .matches-page {
        width: 90%;
        max-width: 1050px;
        margin: 45px auto;
    }

    .matches-page h2 {
        color: #1e3a5f;
    }

    .match-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 25px;
    }

    .match-header h2 {
        margin: 0;
    }

    .match-btn {
        display: inline-block;
        background: #1e3a5f;
        color: white;
        padding: 11px 17px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        font: inherit;
        font-size: 14px;
    }

    .match-btn:hover {
        background: #162d4a;
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

    .danger-btn {
        background: #c0392b;
    }

    .danger-btn:hover {
        background: #a93226;
    }

    .match-card {
        background: white;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .06);
    }

    .matches-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .matches-table th,
    .matches-table td {
        padding: 15px;
        border-bottom: 1px solid #e5e5e5;
        text-align: left;
    }

    .matches-table th {
        background: #edf1f5;
        color: #1e3a5f;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .06);
    }

    .table-actions,
    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .table-actions form {
        margin: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group>label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="time"],
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font: inherit;
    }

    .player-options {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 12px;
        max-height: 220px;
        overflow-y: auto;
    }

    .player-option {
        display: block;
        padding: 9px;
        cursor: pointer;
    }

    .player-option input {
        margin-right: 8px;
    }

    .field-hint {
        color: #777;
        font-size: 13px;
    }

    .alert {
        background: #e6f4ea;
        color: #256b37;
        padding: 13px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .error-box {
        background: #fdecea;
        color: #9b2525;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .detail-row {
        padding: 13px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-row strong {
        color: #1e3a5f;
    }

    .back-link {
        display: inline-block;
        margin-top: 25px;
    }

    /* Task 8 - Match Search, Filtering and Pagination */

    .match-filter-form {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 15px;
        padding: 22px;
        margin-bottom: 25px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
    }

    .match-filter-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        flex: 1 1 170px;
    }

    .match-filter-field label {
        font-size: 13px;
        font-weight: 600;
        color: #1e3a5f;
    }

    .match-filter-field input,
    .match-filter-field select {
        padding: 11px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background: white;
        color: #334155;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
    }

    .match-filter-field input:focus,
    .match-filter-field select:focus {
        outline: none;
        border-color: #1e3a5f;
        box-shadow: 0 0 0 2px rgba(30, 58, 95, 0.1);
    }

    .match-filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .match-clear-btn {
        display: inline-block;
        padding: 10px 15px;
        background: #e2e8f0;
        color: #1e3a5f;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .match-clear-btn:hover {
        background: #cbd5e1;
    }

    .match-pagination {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 22px;
        color: #475569;
        font-size: 14px;
    }

    .match-pagination p {
        margin: 0;
    }

    .match-pagination-buttons {
        display: flex;
        gap: 10px;
    }

    .match-page-btn {
        display: inline-block;
        padding: 9px 15px;
        border-radius: 6px;
        background: #1e3a5f;
        color: white;
        text-decoration: none;
        font-size: 14px;
    }

    .match-page-btn:hover {
        background: #162d4a;
        color: white;
    }

    .match-page-btn.disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    @media (max-width: 650px) {
        .match-filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .match-filter-field,
        .match-filter-buttons {
            width: 100%;
        }
    }

    @media (max-width: 650px) {
        .match-header {
            flex-wrap: wrap;
        }

        .match-card {
            padding: 20px;
        }
    }
</style>