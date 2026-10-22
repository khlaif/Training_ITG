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
