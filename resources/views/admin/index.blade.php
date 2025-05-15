<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Grand Archives</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121246;
            color: #121246;
            margin: 0;
            padding: 20px;
        }
        .header {
            background: #ded9c3;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .button {
            background: linear-gradient(90deg, #b5835a, #8c5f3f);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            transition: transform 0.1s ease, box-shadow 0.3s ease;
        }
        .button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(181, 131, 90, 0.3);
        }
        .section {
            margin-bottom: 40px;
            background: #ded9c3;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .section h2 {
            color: #121246;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #f0f0e4;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #b5835a;
        }
        th {
            background: #b5835a;
            color: #ffffff;
            font-weight: bold;
        }
        tr:hover {
            background: #e0dcc5;
        }
        .action-button {
            background: #b5835a;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            transition: background 0.3s ease;
        }
        .action-button:hover {
            background: #8c5f3f;
        }
        .action-button.delete {
            background: #ff3333;
        }
        .action-button.delete:hover {
            background: #cc0000;
        }
        .paid-button {
            background: #6aa933;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .paid-button:hover {
            background: #558b2f;
        }
        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .message.success {
            background: #6aa933;
            color: #fff;
        }
        .message.error {
            background: #ff3333;
            color: #fff;
        }
        .note {
            color: #121246;
            font-style: italic;
            margin-top: 10px;
            text-align: center;
        }
        /* Genres Section - Card Layout */
        .genres-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 10px;
        }
        .genre-card {
            background: #f0f0e4;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .genre-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(181, 131, 90, 0.3);
        }
        .genre-card h3 {
            margin: 0 0 10px;
            font-size: 1.2rem;
            color: #121246;
        }
        .genre-card p {
            margin: 0 0 15px;
            font-size: 0.9rem;
            color: #555;
        }
        .genre-card .actions {
            display: flex;
            gap: 10px;
        }
        /* Search Bar Styling */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }
        .search-container input {
            padding: 10px 40px 10px 15px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #b5835a;
            border-radius: 20px;
            font-size: 1rem;
            background: #f0f0e4;
            transition: border-color 0.3s ease;
        }
        .search-container input:focus {
            outline: none;
            border-color: #8c5f3f;
            box-shadow: 0 0 5px rgba(181, 131, 90, 0.5);
        }
        .search-container input::placeholder {
            color: #999;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .search-container input:focus::placeholder {
            transform: translateX(10px);
            opacity: 0;
        }
        .search-container .clear-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b5835a;
            font-size: 1.2rem;
            cursor: pointer;
            display: none;
        }
        .search-container .clear-search:hover {
            color: #8c5f3f;
        }
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal.show {
            opacity: 1;
        }
        .modal-content {
            background: #ded9c3;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }
        .modal.show .modal-content {
            transform: scale(1);
        }
        .modal-content p {
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #121246;
        }
        .modal-content .warning {
            color: #ff3333;
            font-size: 0.9rem;
            margin-bottom: 20px;
            font-style: italic;
        }
        .modal-content button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .modal-content .confirm {
            background: #ff3333;
            color: #fff;
        }
        .modal-content .confirm:hover {
            background: #cc0000;
        }
        .modal-content .cancel {
            background: #6aa933;
            color: #fff;
        }
        .modal-content .cancel:hover {
            background: #558b2f;
        }
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .genres-container {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            .genre-card {
                padding: 10px;
            }
            .genre-card h3 {
                font-size: 1rem;
            }
            .genre-card p {
                font-size: 0.85rem;
            }
            .genre-card .actions button {
                padding: 5px 10px;
                font-size: 0.9rem;
            }
            .search-container input {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">Admin Dashboard</div>

    @if(session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif

    <!-- Book Inventory Section -->
    <div class="section">
        <h2>Book Inventory</h2>
        <a href="{{ route('admin.create') }}"><button class="button">Add New Book</button></a>
        <a href="{{ route('admin.suppliers.create') }}"><button class="button">Add New Supplier</button></a>
        @if($books->isEmpty())
            <p class="note">No books available in the inventory.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Quantity in Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author ?? 'Unknown' }}</td>
                            <td>
                                @if($book->genres->isNotEmpty())
                                    {{ $book->genres->pluck('name')->join(', ') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('admin.edit', $book) }}"><button class="action-button">Edit</button></a>
                                <a href="{{ route('admin.adjustStock', $book) }}"><button class="action-button">Adjust Stock</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="note">Click "Adjust Stock" to view stock history for a book.</p>
        @endif
    </div>

    <!-- Borrowed Books Section -->
    <div class="section">
        <h2>Borrowed Books</h2>
        @if($borrowedBooks->isEmpty())
            <p class="note">No borrowed books at the moment.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>User</th>
                        <th>Contact No</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Borrowed At</th>
                        <th>Due Date</th>
                        <th>Returned At</th>
                        <th>Late Fee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $borrowedBook)
                        <tr>
                            <td>{{ $borrowedBook->book->title }}</td>
                            <td>{{ $borrowedBook->user->name }}</td>
                            <td>{{ $borrowedBook->user->contact_no ?? 'N/A' }}</td>
                            <td>{{ $borrowedBook->user->address ?? 'N/A' }}</td>
                            <td>{{ ucfirst($borrowedBook->status) }}</td>
                            <td>{{ $borrowedBook->borrowed_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $borrowedBook->due_date->format('Y-m-d') }}</td>
                            <td>{{ $borrowedBook->returned_at ? $borrowedBook->returned_at->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>${{ number_format($borrowedBook->late_fee, 2) }}</td>
                            <td>
                                @if($borrowedBook->status === 'borrowed')
                                    <form action="{{ route('admin.updateBorrowStatus', $borrowedBook) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="returned">
                                        <button type="submit" class="action-button">Mark as Returned</button>
                                    </form>
                                @endif
                                @if($borrowedBook->late_fee > 0)
                                    <form action="{{ route('admin.markAsPaid', $borrowedBook) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="paid-button">Mark as Paid</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Genres Section -->
    <div class="section">
        <h2>Manage Genres</h2>
        <a href="{{ route('admin.genres.create') }}"><button class="button">Add New Genre</button></a>
        @if($genres->isEmpty())
            <p class="note">No genres available.</p>
        @else
            <div class="search-container">
                <input type="text" id="genreSearch" placeholder="Search genres..." onkeyup="searchGenres()">
                <button class="clear-search" onclick="clearSearch()">✖</button>
            </div>
            <div class="genres-container" id="genresContainer">
                @foreach($genres as $genre)
                    <div class="genre-card">
                        <h3>{{ $genre->name }}</h3>
                        <p>Books: {{ $genre->books->count() }}</p>
                        <div class="actions">
                            <a href="{{ route('admin.genres.edit', $genre) }}"><button class="action-button">Edit</button></a>
                            <button class="action-button delete" onclick="openModal('{{ $genre->id }}', '{{ $genre->name }}', {{ $genre->books->count() }})">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete the genre "<span id="genreName"></span>"?</p>
            <p class="warning" id="genreWarning"></p>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm">Yes, Delete</button>
                <button type="button" class="cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>
</body>
<script>
    // Search functionality for genres
    function searchGenres() {
        const input = document.getElementById('genreSearch').value.toLowerCase();
        const container = document.getElementById('genresContainer');
        const cards = container.getElementsByClassName('genre-card');
        const clearButton = document.querySelector('.clear-search');

        clearButton.style.display = input ? 'block' : 'none';

        for (let i = 0; i < cards.length; i++) {
            const genreName = cards[i].querySelector('h3').textContent.toLowerCase();
            if (genreName.includes(input)) {
                cards[i].style.display = '';
            } else {
                cards[i].style.display = 'none';
            }
        }
    }

    // Clear search input
    function clearSearch() {
        const input = document.getElementById('genreSearch');
        input.value = '';
        const clearButton = document.querySelector('.clear-search');
        clearButton.style.display = 'none';
        searchGenres();
    }

    // Modal functionality for delete confirmation
    function openModal(genreId, genreName, booksCount) {
        const modal = document.getElementById('deleteModal');
        const genreNameSpan = document.getElementById('genreName');
        const genreWarning = document.getElementById('genreWarning');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/genres/${genreId}`;
        genreNameSpan.textContent = genreName;
        genreWarning.textContent = booksCount > 0 ? `Warning: This genre is associated with ${booksCount} book(s). Deleting it may affect those books.` : '';
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('show'), 10);
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('show');
        setTimeout(() => modal.style.display = 'none', 300);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeModal();
        }
    };
</script>
</html>