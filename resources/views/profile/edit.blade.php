<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Grand Archives</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "Inter-Regular", sans-serif;
            background: #f0f0e4;
            color: #121246;
            overflow-x: hidden;
            line-height: 1.6;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            width: 100%;
            min-height: 100vh;
            padding-top: 80px;
        }

        .profile-content {
            background: #ded9c3;
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
            margin: 20px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-header {
            text-align: center;
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #121246;
            background: linear-gradient(to right, #121246, #b5835a);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .form-grid {
            display: grid;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 500;
            color: #121246;
        }

        .form-group input,
        .form-group textarea {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #b5835a;
            font-size: 14px;
            background: #fff;
            color: #121246;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .profile-picture-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #b5835a;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 10px;
        }

        .profile-picture:hover {
            transform: scale(1.05);
        }

        .change-picture-button {
            display: inline-block;
            padding: 10px 20px;
            background: #b5835a;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .change-picture-button:hover {
            background: #9a6b47;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(181, 131, 90, 0.3);
        }

        .change-picture-button input[type="file"] {
            display: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .update-button,
        .discard-button {
            padding: 12px 25px;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .update-button {
            background: #121246;
        }

        .update-button:hover {
            background: #0d0e33;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(18, 18, 70, 0.3);
        }

        .discard-button {
            background: #b5835a;
        }

        .discard-button:hover {
            background: #9a6b47;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(181, 131, 90, 0.3);
        }

        .error-message {
            color: #c22d2d;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .profile-content {
                padding: 20px;
            }

            .profile-picture {
                width: 120px;
                height: 120px;
            }

            .form-group input,
            .form-group textarea {
                padding: 10px;
            }

            .button-group {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .profile-content {
                margin: 10px;
                padding: 15px;
            }

            .profile-picture {
                width: 100px;
                height: 100px;
            }

            .profile-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-content">
            <div class="profile-header-container">
                <div class="profile-header">
                    <h1>EDIT PROFILE</h1>
                </div>
                <div class="profile-picture-container">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/logo1.png') }}" alt="Profile Picture" class="profile-picture">
                    <label class="change-picture-button">
                        Change Picture
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    </label>
                    @error('profile_picture')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_no">Contact Number</label>
                        <input type="text" name="contact_no" id="contact_no" value="{{ old('contact_no', Auth::user()->contact_no) }}">
                        @error('contact_no')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" id="address">{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="update-button">Update Profile</button>
                    <a href="{{ route('user.profile') }}" class="discard-button">Discard</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>