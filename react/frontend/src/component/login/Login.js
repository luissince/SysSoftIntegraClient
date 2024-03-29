import React, { useRef, useState } from "react";

import { useDispatch } from 'react-redux';
import { login } from '../../store/authSlice';

import { NotificationContainer, NotificationManager } from 'react-notifications';
import {images } from '../../constants/';

const Login = () => {

    const [usuario, setUsuario] = useState('');
    const [clave, setClave] = useState('');
    const [process, setProcess] = useState(false);

    const refUsuario = useRef(null);
    const refClave = useRef(null);

    const dispatch = useDispatch()

    const onEventLogin = async () => {
        if (usuario == "") {
            NotificationManager.warning("Ingrese su usuario.", "Login");
            refUsuario.current.focus();
            return;
        }

        if (clave == "") {
            NotificationManager.warning("Ingrese su Contraseña.", "Login");
            refClave.current.focus();
            return;
        }

        setProcess(true);

        await new Promise(function (resolve, reject) {
            setTimeout(resolve, 2000);
        });

        const user = {
            id: 342342344,
            usuario: usuario,
            clave: clave,
        };
        dispatch(login({ user: user }))
    }

    return <>
        <section className="material-half-bg-white">
            <div className="cover"></div>
        </section>
        <section className="login-content">

            <div className="tile p-0">
                {
                    process ?
                        <div className="overlay">
                            <div className="m-loader mr-4">
                                <svg className="m-circular" viewBox="25 25 50 50">
                                    <circle className="path" cx="50" cy="50" r="20" fill="none" strokeWidth="4" strokeMiterlimit="10"></circle>
                                </svg>
                            </div>
                            <h4 className="l-text text-white">Procesando Petición...</h4>
                        </div>
                        :
                        null
                }


                <div className="tile-body">
                    <div className="login-box">
                        <div className="login-form">
                            <h4 className="text-center mb-3">
                                <img className="img-fluid" src={images.logo} alt="Logo" />
                            </h4>
                            <h4 className="login-head"><i className="fa fa-lg fa-fw fa-user"></i>Credenciales de Acceso</h4>
                            <div className="form-group">
                                <label className="control-label">Usuario</label>
                                <input
                                    className="form-control"
                                    type="text"
                                    placeholder="Dijite el usuario"
                                    ref={refUsuario}
                                    value={usuario}
                                    onChange={(event) => setUsuario(event.target.value)}
                                    
                                    onKeyUp={(event) =>{
                                        if(event.key === "Enter"){
                                            onEventLogin();
                                            event.preventDefault();
                                        }
                                    }}
                                    autoFocus />
                            </div>
                            <div className="form-group">
                                <label className="control-label">Contraseña</label>
                                <input
                                    className="form-control"
                                    type="password"
                                    placeholder="Dijite la contraseña"
                                    ref={refClave}
                                    value={clave}
                                    onChange={(event) => setClave(event.target.value)}
                                    
                                    onKeyUp={(event) =>{
                                        if(event.key === "Enter"){
                                            onEventLogin();
                                            event.preventDefault();
                                        }
                                    }}
                                />
                            </div>
                            <div className="form-group btn-container">
                                <button
                                    className="btn btn-primary btn-block"
                                    onClick={() => onEventLogin()}>
                                    <i className="fa fa-sign-in fa-lg fa-fw"></i> Ingresar
                                </button>
                            </div>
                            <div className="form-group text-center">
                                <label className="control-label text-danger" id="lblErrorMessage"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <NotificationContainer />
        </section>
    </>
}

export default Login;