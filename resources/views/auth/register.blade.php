@extends('layouts.app')

@section('title', 'Registro - Projects Manager')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-2xl rounded-lg px-8 pt-6 pb-8 mb-4">

                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Crear Cuenta</h1>
                    <p class="text-gray-600">Registrate para comenzar a usar Projects Manager</p>
                </div>

                <div id="alert-container"></div>

                <form id="registerForm" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                            Nombre
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required
                        >
                        <p class="text-red-500 text-xs italic mt-1 hidden" id="name-error"></p>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            Correo Electronico
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required
                        >
                        <p class="text-red-500 text-xs italic mt-1 hidden" id="email-error"></p>
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            Contrasena
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required
                        >
                        <p class="text-red-500 text-xs italic mt-1 hidden" id="password-error"></p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">
                            Confirmar Contrasena
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            required
                        >
                        <p class="text-red-500 text-xs italic mt-1 hidden" id="password_confirmation-error"></p>
                    </div>

                    <div class="flex items-center justify-between">
                        <button
                            type="submit"
                            id="submitBtn"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105"
                        >
                            Registrarse
                        </button>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-gray-600 text-sm">
                        Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Inicia sesion aqui
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div style="max-width: 100vw;background-color: rgba(0, 0, 0, 0.5)" id="jsonModal" class="hidden top-0 left-0 bottom-0 right-0 absolute flex items-center justify-center">
        <div class="bg-white w-11/12 max-w-lg p-6 rounded-xl shadow-xl overflow-hidden">
            <h2 class="text-xl font-bold mb-4">Respuesta del servidor</h2>
            <pre id="jsonContent" class="bg-gray-100 p-3 rounded text-sm overflow-x-scroll"></pre>
            <button id="closeModal" class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Cerrar
            </button>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            document.querySelectorAll('.text-red-500').forEach(el => el.classList.add('hidden'));
            document.getElementById('alert-container').innerHTML = '';

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Registrando...';

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };

            try {
                const response = await axios.post('/api/v1/auth/register', formData, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = response.data;

                showModal(data);

            } catch (error) {
                if (error.response) {
                    const data = error.response.data;

                    if (data.validation_errors) {
                        Object.keys(data.validation_errors).forEach(field => {
                            const errorEl = document.getElementById(field + '-error');
                            if (errorEl) {
                                errorEl.textContent = data.validation_errors[field][0];
                                errorEl.classList.remove('hidden');
                            }
                        });
                    } else {
                        showAlert(data.message || 'Error al registrarse', 'error');
                    }

                } else {
                    showAlert('Error de conexion. Intenta de nuevo.', 'error');
                }
            }

            submitBtn.disabled = false;
            submitBtn.textContent = 'Registrarse';
        });

        function showAlert(message, type) {
            const alertClass = type === 'success'
                ? 'bg-green-100 border-green-400 text-green-700'
                : 'bg-red-100 border-red-400 text-red-700';

            document.getElementById('alert-container').innerHTML = `
                <div class="${alertClass} border px-4 py-3 rounded-lg mb-4 relative">
                    <span class="block sm:inline">${message}</span>
                </div>
            `;
        }

        function showModal(data) {
            document.getElementById('jsonContent').textContent = JSON.stringify(data, null, 2);
            document.getElementById('jsonModal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('jsonModal').classList.add('hidden');
        });
    </script>
@endsection
