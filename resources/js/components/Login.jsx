import React, { useState } from 'react';
import axios from 'axios';

function Login() {

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [remember, setRemember] = useState(false);

const handleSubmit = async (e) => {

    e.preventDefault();

    try {

        const response = await axios.post('/api/v1/login', {
            email: email,
            password: password,
            remember: remember
        });

        console.log('LOGIN RESPONSE:', response.data);

       const token = response.data.token;


    localStorage.setItem('token', token);


const token = response.data.token;

console.log('1 TOKEN RECEIVED:', token);

localStorage.setItem('token', token);

console.log('2 TOKEN AFTER SAVE:', localStorage.getItem('token'));

return;

    } catch (error) {

        console.log('LOGIN ERROR:', error.response?.data);

    }
};
    return (
        <div className="row justify-content-center">

            <div className="col-md-5">

                <div className="card shadow">

                    <div className="card-header text-center">
                        <h3>SMS Login</h3>
                    </div>

                    <div className="card-body">

                        <form onSubmit={handleSubmit}>

                            <div className="mb-3">

                                <label className="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    className="form-control"
                                    value={email}
                                    onChange={(e) => setEmail(e.target.value)}
                                />

                            </div>

                            <div className="mb-3">

                                <label className="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    className="form-control"
                                    value={password}
                                    onChange={(e) => setPassword(e.target.value)}
                                />

                            </div>

                            <div className="form-check mb-3">

                                <input
                                    type="checkbox"
                                    className="form-check-input"
                                    checked={remember}
                                    onChange={(e) => setRemember(e.target.checked)}
                                />

                                <label className="form-check-label">
                                    Remember Me
                                </label>

                            </div>

                            <button
                                type="submit"
                                className="btn btn-primary w-100"
                            >
                                Login
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    );
}

export default Login;
