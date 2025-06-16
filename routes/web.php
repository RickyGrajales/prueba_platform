<?php
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AsistenciaController; 
use App\Http\Controllers\EvaluadorPedagogicoController;
use App\Http\Middleware\DisableCache;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\guest;
use Illuminate\Support\Facades\Auth;



// Página de inicio
Route::get('/home', function () {
    return view('home.index');
});

// Vista y proceso de login
Route::get('/login', function() {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por middleware de administrador
// Route::middleware(['auth',DisableCache::class, AdminMiddleware::class])->group(function () {
  
// });
Route::get('/admin/administrador', [AdminController::class, 'index'])->name('admin.administrador');
Route::get('/admin/registro', [AuthController::class, 'showRegisterForm'])->name('admin.registro');
Route::post('/admin/registro', [AuthController::class, 'registro']);




// Vista de los estudiantes
Route::middleware(['auth'])->group(function () {

    Route::get('/estudiantes/estudiante', function () {
        return view('estudiantes.estudiante');
    })->name('estudiantes.estudiante');
    
});





// Ruta para mostrar la vista de actualización de datos del estudiante
Route::get('/estudiantes/actualizarDatos', [EstudianteController::class, 'editar'])->name('estudiante.editar');





// Ruta para procesar la actualización de datos
Route::put('/estudiantes/actualizardatos', [EstudianteController::class, 'actualizar'])->name('estudiante.actualizar');






// Vista del profesor
Route::middleware(['auth'])->group(function () {

    Route::get('/profesores/profesor', function () {
        return view('profesores.profesor');
    })->name('profesores.profesor');
    
    Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
    
    Route::get('/profesores/actualizarDatos', [ProfesorController::class, 'editar'])->name('profesor.editar');
    
    Route::put('/profesores/actualizar', [ProfesorController::class, 'actualizar'])->name('profesor.actualizar');
    
    Route::put('/profesor/actualizar', [ProfesorController::class, 'actualizar'])->name('profesor.actualizar');
    
    
    
});




Route::get('/registro', function() {
    return view('admin.registro');
});

// 
Route::post('/registro', [AuthController::class, 'register'])->name('registro');



// Route::middleware(['auth'])->group(function () {
    // Dashboard principal (ahora protegido)
    
//     Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');

//     // Editar datos
//     Route::get('/profesores/actualizarDatos', [ProfesorController::class, 'editar'])->name('profesor.editar');
//     Route::put('/profesores/actualizar', [ProfesorController::class, 'actualizar'])->name('profesor.actualizar');
// // });



// Route::middleware(['auth', AdminMiddleware::class])->group(function () {
//     // Ruta para mostrar el formulario de edición del administrador
//     Route::get('/administrador/editar', [AdminController::class, 'editar'])->name('administrador.editar');
    
//     // Ruta para procesar la actualización de datos del administrador
//     Route::put('/administrador/actualizar', [AdminController::class, 'actualizar'])->name('administrador.actualizar');
// });


// Route::middleware(['auth', AdminMiddleware::class])->group(function () {
// });
// Ruta para mostrar la vista de actualización del administrador





Route::get('/admin/actualizarDatos', [AdminController::class, 'editar'])->name('admin.editar');
   




// Ruta para procesar la actualización de datos del administrador
Route::put('/admin/actualizar', [AdminController::class, 'actualizar'])->name('admin.actualizar');




Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('/admin/administrador', [AdminController::class, 'index'])->name('admin.administrador');

});







//Ruta del Estudiante dentro de su misma vista para actualizar sus datos
Route::get('/estudiantes/actualizar', [EstudianteController::class, 'editar'])->name('estudiantes.editar');
Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes.index');




//Me redirecciona desde el index (Pagina Principal) hacia la vista (quienesSomos)
Route::get('/quienesSomos', function () {
    return view('home.quienesSomos');
})->name('quienesSomos');


//Me redirecciona desde el index (Pagina Principal) hacia la vista (contactos)
Route::get('/contactos', function () {
    return view('home.contactos');
})->name('contactos');



//Esta ruta me devuelve desde la vista (contactos) hacia la vista (index)-(home) de la pagina principal
Route::get('/', function () {
    return view('home.index');
})->name('home.index');


//Descargas 

Route::get('/descargar/boletin/{archivo}', function ($archivo) {
    $rutaArchivo = public_path("img/$archivo");
    
    if (file_exists($rutaArchivo)) {
        return response()->download($rutaArchivo);
    }

    abort(404);
})->name('descargar.boletin');

Route::get('/descargar/certificados/{archivo}', function ($archivo) {
    $rutaArchivo = public_path("img/$archivo");
    
    if (file_exists($rutaArchivo)) {
        return response()->download($rutaArchivo);
    }

    abort(404);
})->name('descargar.certificados');


//Ruta para las notificaciones del estudiante por parte del administrador
Route::get('/notificaciones/verificar', [NotificacionController::class, 'verificar'])->name('notificaciones.verificar');

//Ruta de Encuesta}
Route::get('/encuesta', [EncuestaController::class, 'ver'])->name('encuesta.ver');


//Ruta de Calendario
Route::get('/calendario', [CalendarioController::class, 'ver'])->name('calendario.ver');


// Ruta para visualizar la vista de la encuesta del alumno
Route::get('/admin/encuesta-alumno', function () {
    return view('admin.encuesta_alumno');
})->name('encuesta.alumno');


// Ruta para visualizar la vista del administrador
Route::get('/admin/administrador', function () {
    return view('admin.administrador');
})->name('admin.administrador');



// Ruta para visualizar la encuesta (ya existente)
Route::get('/estudiantes/encuesta', [EncuestaController::class, 'ver'])->name('estudiantes.encuesta');


Route::post('/admin/encuesta-alumno/guardar', [EncuestaController::class, 'guardar'])
    ->name('encuesta.guardar');


// ========================== 🛠️ RUTAS DEL ADMINISTRADOR =======================//


//Ruta en donde el administrador puede ver la encuesta    
Route::get('/admin/encuesta', [EncuestaController::class, 'mostrarEncuesta'])->name('admin.encuesta');



//Ruta donde el administrador puede agregar preguntas a la encuesta
Route::post('/admin/encuesta/guardar', [EncuestaController::class, 'guardarPreguntas'])->name('admin.encuesta.guardar');



//Ruta de adlministrador para eliminar preguntas de la encuesta
Route::delete('/admin/encuesta/eliminar/{id}', [EncuestaController::class, 'eliminarPregunta'])->name('encuesta.eliminar');



// ==================== 🎓 RUTAS DE LOS ESTUDIANTES ====================


// Ruta para visualizar la encuesta (ya existente)
Route::get('/estudiantes/encuesta', [EncuestaController::class, 'ver'])->name('estudiantes.encuesta');




// Estudiante envía sus respuestas de la encuesta
Route::post('/estudiantes/encuesta/guardar', [EncuestaController::class, 'guardarRespuestas'])->name('estudiantes.encuesta.guardar');


//===============================📚 Rutas de Grados=================================//


//Ruta de la vista creación de grados
Route::get('/admin/crear-grados', function () {
    return view('admin.crear_grados');
})->name('admin.crear_grados');


Route::get('/admin/grados', [CursoController::class, 'index'])->name('admin.grados');


//Ruta para guardar un nuevo grado
Route::post('/admin/grado/guardar', [CursoController::class, 'guardar'])->name('grado.guardar');



//Ruta para crear curso
Route::get('/admin/crear-grado', [CursoController::class, 'index'])->name('admin.crear_grado');


//Administrador puede ver los grados escolares
Route::get('/admin/grados', [CursoController::class, 'index'])->name('admin.grados');




//Ruta para guardar un nuevo grado
Route::post('/admin/grado/guardar', [CursoController::class, 'guardar'])->name('grado.guardar');




//Ruta para eliminar cursos
Route::delete('/grado/eliminar/{id}', [CursoController::class, 'eliminar'])->name('grado.eliminar');



// Registro del administrador (con autenticación)
Route::get('/admin/registro', [AdminController::class, 'registro'])->name('admin.registro')->middleware('auth');


//Retorna la vista de encuesta.blade.php sin preguntas nuevas
// Route::get('/encuesta', [EncuestaController::class, 'mostrarEncuesta'])->name('estudiantes.encuesta');



Route::post('/encuesta/responder', [EncuestaController::class, 'guardarRespuestas'])->name('estudiantes.guardarRespuestas');



//Ruta para ver la vista calendario desde la vista estudiante
Route::prefix('estudiantes')->group(function () {
    Route::get('calendario', [CalendarioController::class, 'ver'])->name('calendario.ver');
});




// Ruta para mostrar la vista de crear eventos

Route::get('/admin/eventos', [EventoController::class, 'index'])->name('admin.eventos');



// Ruta para guardar los eventos
Route::post('/admin/eventos', [EventoController::class, 'store'])->name('admin.eventos.store');



// Ruta para obtener los eventos para el calendario
Route::get('/estudiantes/eventos', [EventoController::class, 'obtenerEventos'])->name('estudiantes.eventos');




Route::get('/api/eventos', [EventoController::class, 'obtenerEventos'])->name('api.eventos');



//Ruta para eliminar los eventos que ya se notificaron
Route::post('admin/eventos/eliminar', [EventoController::class, 'eliminarEventos'])->name('admin.eventos.eliminar');





//Ruta para notificar al estudiante que hay un nuevo evento
Route::get('/calendario', [EstudianteController::class, 'verCalendario'])->name('calendario.ver');



Route::get('/estudiante', [App\Http\Controllers\EstudianteController::class, 'verEstudiante'])->name('estudiante.ver');




Route::get('/profesor/panel', [ProfesorController::class, 'mostrarPanel'])->name('profesor.panel');



// Route::get('/profesor/grado', [ProfesorController::class, 'mostrarGrado'])->name('profesor.grado');

// Route::get('/grados/grado', [ProfesorController::class, 'mostrarGrado'])->name('profesor.grado');


// Route::middleware(['auth'])->group(function () { 
// });
Route::get('/grados/grado', [ProfesorController::class, 'mostrarGrado'])->name('profesor.grado');





// Guardar nuevo profesor
Route::post('/profesor/guardar', [AdminController::class, 'guardarProfesor'])->name('profesor.guardar');



Route::post('/guardar-profesor', [AdminController::class, 'guardarProfesor'])->name('profesor.guardar');




//Ruta para crear, editar, eliminar y visualizar materias
//Creadas por el administrador de ASODISVALLE
Route::prefix('admin')->group(function () {
    Route::get('/materias', [MateriaController::class, 'index'])->name('admin.materias.index');
    Route::get('/materias/crear', [MateriaController::class, 'create'])->name('admin.materias.crear');
    Route::get('/materias/editar/{id}', [MateriaController::class, 'edit'])->name('admin.materias.edit');
    Route::post('/materias/store', [MateriaController::class, 'store'])->name('admin.materias.store');
    Route::delete('/materias/{materia}', [MateriaController::class, 'destroy'])->name('admin.materias.destroy');
    Route::put('/materias/update', [MateriaController::class, 'update'])->name('admin.materias.update');

});





//Ruta para guardar la asistencia de los Estudiantes
Route::post('/guardar-asistencia', [AsistenciaController::class, 'guardarAsistencia'])->name('guardar.asistencia');




//Ruta para cargar la vista del Evaluador Pedagógico
Route::get('/evaluador_pedagogico', [EvaluadorPedagogicoController::class, 'index'])
    ->middleware('auth') // Si necesitas que esté autenticado
    ->name('evaluador_pedagogico');










//--------------------------------RUTAS DEL COLEGIO PBJ-----------------------------------------------------//

use App\Http\Controllers\AdminPBJController;
use App\Http\Controllers\UsuarioPBJController;
use App\Http\Controllers\AuthPBJController;
use App\Http\Controllers\ProfesorPBJController;
use App\Http\Controllers\EstudiantePBJController;
use App\Http\Controllers\EncuestaPBJController;
use App\Http\Controllers\EventoPBJController;
use App\Http\Controllers\MateriaPBJController;






// Ruta para cargar la vista loginPBJ.blade.php 
// desde la carpeta Z_PBJ/authPBJ
Route::get('/loginPBJ', function () {
    return view('Z_PBJ.authPBJ.loginPBJ');
})->name('loginPBJ');

//Ruta para el inicio de sesión de los usuarios
Route::post('/loginPBJ', [AuthPBJController::class, 'login'])->name('login.pbj');






//Ruta para cargar la vista del administradorPBJ.blade.php
Route::get('/adminPBJ', [AdminPBJController::class, 'index'])->name('adminPBJ.index');




//Ruta para redireccionar a la vista crear_usuarioPBJ,blade.php
//Desde la vista administradorPBJ.blade.php
Route::get('/adminPBJ/crear-usuario', function () {
    return view('Z_PBJ.adminPBJ.crear_usuarioPBJ');
})->name('adminPBJ.crear_usuarioPBJ');





//Rutas para guardar usuarios en la base de datos: 
Route::get('/adminPBJ/crear-usuario', [UsuarioPBJController::class, 'create'])->name('usuariosPBJ.create');
Route::post('/adminPBJ/crear-usuario', [UsuarioPBJController::class, 'store'])->name('usuariosPBJ.store');




//Ruta para retroceder desde la vista crear_usuarioPBJ.blade.php
//Hasta la vista principal que es administradorPBJ.blade.php
Route::get('/adminPBJ/administradorPBJ', [AdminPBJController::class, 'index'])->name('adminPBJ.administradorPBJ');





//Ruta para redirigir desde la vista administradorPBJ.blade.php
//Hasta la vista actualizarDatosPBJ.blade.php
//--------------------------------------------------//
//Ruta para la actualización de datos del administradorPBJ.blade.php

Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/adminPBJ/editar', [AdminPBJController::class, 'editar'])->name('adminPBJ.editar');
    Route::put('/adminPBJ/actualizar', [AdminPBJController::class, 'actualizar'])->name('adminPBJ.actualizar');
});




//Ruta para cargar la vista del administradorPBJ.blade.php
//Después de iniciar sesión
Route::get('/adminPBJ', function () {
    return view('Z_PBJ.adminPBJ.administradorPBJ');
})->name('adminPBJ.inicio');




//Ruta para que el administrador pueda cerrar sesión
// Route::post('/logoutPBJ', function () {
//     Auth::guard('adminpbj')->logout();
//     session()->invalidate();
//     session()->regenerateToken();
//     return redirect()->route('loginPBJ');
// })->name('logoutPBJ');
Route::post('/logoutPBJ', [AuthPBJController::class, 'logout'])->name('logoutPBJ');





//Ruta para retroceder desde la vista actualizarDatosPBJ.blade.php
//Hasta la vista administradorPBJ.blade.php
Route::get('/adminPBJ/administrador', function () {
    return view('Z_PBJ.adminPBJ.administradorPBJ');
})->name('adminPBJ.inicio');





//Ruta para redirigir al administradorPBJ.blade.php
//Hasta la vista encuestaAlumnoPBJ.blade.php
Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/adminPBJ/encuesta-alumno', function () {
        return view('Z_PBJ.adminPBJ.encuestaAlumnoPBJ');
    })->name('adminPBJ.encuesta');
});





//Ruta que me redirije hacia la vista crear_gradoPBJ.blade.php
//Desde la vista administradorPBJ.blade.php, dentro de la misma carpeta
Route::middleware(['auth:usuariospbj'])->group(function () {
    // Otras rutas...

    Route::get('/adminPBJ/crear-grado', function () {
        return view('Z_PBJ.adminPBJ.crear_gradoPBJ');
    })->name('adminPBJ.crear_grado');
});






//Ruta que me redirije desde la vista administradorPBJ.blade.php
//Hasta la vista eventosPBJ.blade.php
// Route::middleware(['auth:usuariospbj'])->group(function () {
//     // Otras rutas...

//     Route::get('/adminPBJ/eventos', function () {
//         return view('Z_PBJ.adminPBJ.eventosPBJ');
//     })->name('adminPBJ.eventos');
// });





//Ruta que me redirije desde la vista administradorPBJ.blade.php
//que esta dentro de la carpeta adminPBJ, hacia la vista
//indexMateriaPBJ.blade.php que esta dentro de la carpeta
//materiasPBJ
Route::middleware(['auth:usuariospbj'])->group(function () {
    // Otras rutas...
Route::get('/adminPBJ/materias', [AdminPBJController::class, 'indexMaterias'])
    ->name('adminPBJ.materias.index');


});





//Ruta para crear los usuarios y guardarlos en la base de datos//
//Se guardan en la tabla usuariospbj, El rol que los crea es el
//administradorPBJ.blade.php desde la vista crear_usuarioPBJ.blade.php
Route::post('/usuariosPBJ/crear', [AdminPBJController::class, 'store'])->name('usuariosPBJ.store');





//Ruta para cargar la vista del profesorPBJ.blade.php
Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/profesorPBJ/inicio', [ProfesorPBJController::class, 'index'])->name('profesorPBJ.inicio');
});





//Ruta para redirigir al profesor
//Hacia la vista profesorPBJ.blade.php
//Cuando el Inicie Sesión
Route::get('/profesorPBJ', function () {
    return view('Z_PBJ.profesoresPBJ.profesorPBJ');
})->name('profesorPBJ.inicio');




// ------------------------------Todas dos Funcionan-----------------------------
//Ruta para redireccionar al profesorPBJ.blade.php
//Hacia la vista actualizarDatosPBJ.blade.php
//-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-/-
//Ruta para que el profesorPBJ.blade.php
//Pueda actualizar datos personales 

Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/profesorPBJ/editar', [ProfesorPBJController::class, 'editar'])->name('profesor.editar');
    Route::put('/profesorPBJ/actualizar', [ProfesorPBJController::class, 'actualizarDatos'])->name('profesorPBJ.actualizarDatos');
});

//-------------------------------------------------------------//






//Ruta para regresar desde la vista actualizarDatosPBJ.blade.php
//Hasta la vista profesorPBJ.blade.php
Route::get('/profesorPBJ', function () {
    return view('Z_PBJ.profesoresPBJ.profesorPBJ');
})->middleware('auth:usuariospbj')->name('profesorPBJ.inicio');





//Ruta para que cargue la vista del estudiante
//Después de iniciar sesión
Route::get('/estudiantepbj/inicio', [EstudiantePBJController::class, 'inicio'])->name('estudiantePBJ.inicio');





//Ruta para que el estudiantePBJ.blade.php,
//Pueda actualizar datos personales
Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/estudiantepbj/editar', [EstudiantePBJController::class, 'editar'])->name('estudiantePBJ.editar');
    Route::post('/estudiantepbj/actualizar', [EstudiantePBJController::class, 'actualizar'])->name('estudiantePBJ.actualizar');
});





//Ruta para redireccionar al estudiantePBJ.blade.php
//Hasta la vista encuestPBJ.blade.php  
// Ruta para mostrar la vista de encuesta del estudiante PBJ
Route::get('/estudiantePBJ/encuesta', function () {
    return view('Z_PBJ.estudiantesPBJ.encuestaPBJ');
})->name('encuesta.ver');





//Rutas de preguntas hechas por el administradorPBJ.blade.php
//Desde la vista encuestAlumnoPBJ.blade.php
//Hasta la vista encuestaPBJ.blade.php de la carpeta 
//estudiantesPBJ
// ADMIN PBJ
Route::get('/adminPBJ/encuesta', [EncuestaPBJController::class, 'verFormularioAdmin'])->name('adminPBJ.encuesta');
Route::post('/adminPBJ/encuesta/guardar', [EncuestaPBJController::class, 'guardarPreguntas'])->name('adminPBJ.encuesta.guardar');







// ESTUDIANTE PBJ
//Esta ruta le muestra al estudiante
//Las preguntas hechas y enviadas por
//El administrador
Route::middleware('auth:usuariospbj')->group(function () {
    Route::get('/estudiantePBJ/encuesta', [EstudiantePBJController::class, 'mostrarEncuesta'])->name('encuesta.ver');
    Route::post('/estudiantePBJ/encuesta/responder', [EncuestaPBJController::class, 'guardarRespuestas'])->name('estudiantePBJ.encuesta.responder');

});






//Esta ruta es para que el estudiante
//Responda las preguntas y se queden
//Guardadas en la base de datos
Route::post('/estudiantePBJ/encuesta/responder', [EstudiantePBJController::class, 'guardarRespuestas'])
    ->name('estudiantePBJ.encuesta.responder');





//Esta ruta redirecciona al estudiantePBJ.blade.php
//Hacia la vista notificacionPBJ.blade.php
// Route::get('/pbj/eventos', function () {
//     return view('Z_PBJ.estudiantesPBJ.notificacionPBJ');
// })->name('pbj.eventos');






//Rutas de creación de eventos por parte del 
//adaministradorPBJ.blade.php
// Eventos PBJ
// Eventos PBJ
Route::get('/adminPBJ/eventos', [App\Http\Controllers\EventosPBJController::class, 'index'])->name('adminPBJ.eventos');
Route::post('/adminPBJ/eventos', [App\Http\Controllers\EventosPBJController::class, 'store'])->name('eventosPBJ.store');
Route::delete('/adminPBJ/eventos/eliminar-todos', [App\Http\Controllers\EventosPBJController::class, 'destroyAll'])->name('eventosPBJ.destroyAll');






//Ruta para notificar al estudiantePBJ.blade.php
//De los proximos eventos, los eventos cargan en la vista
//notificacionPBJ.blade.php
Route::get('/notificacionPBJ', [EstudiantePBJController::class, 'notificacionPBJ'])->name('notificacionPBJ');




//Ruta para cargar los eventos en la vista
//notificacionPBJ.blade.php
Route::get('/pbj/eventos', [App\Http\Controllers\EstudiantePBJController::class, 'notificacionPBJ'])->name('pbj.eventos');







//Ruta para eliminar todas las preguntas echas por
//El administrador desde la vista encuestaAlumnoPBJ.blade.php
Route::delete('/adminPBJ/encuesta/eliminar-todas', [App\Http\Controllers\AdminPBJController::class, 'eliminarTodas'])
    ->name('adminPBJ.encuesta.eliminarTodas');






// Ruta para mostrar la vista de gradoPBJ
// Route::get('/profesor/pbj/grado', function () {
//     return view('Z_PBJ.gradosPBJ.gradoPBJ');
// })->name('profesor.grado');

// Mostrar la vista gradoPBJ (desde carpeta Z_PBJ.gradosPBJ)
Route::get('/profesorpbj/vista/grado', function () {
    return view('Z_PBJ.gradosPBJ.gradoPBJ');
})->name('profesorpbj.vista.grado');




//Ruta para mostrar el nombre y el grado
//Del profesor autenticado, en la vista
//gradoPBJ.blade.php
// Route::middleware(['auth:usuariospbj'])->group(function () {
//     Route::get('/profesorPBJ/grado', [ProfesorPBJController::class, 'verGrado'])->name('profesor.grado');
// });

// Mostrar nombre y grado del profesorPBJ autenticado
Route::middleware(['auth:usuariospbj'])->group(function () {
    Route::get('/profesorPBJ/grado', [ProfesorPBJController::class, 'verGrado'])
        ->name('profesorPBJ.grado');
});





//Ruta para llamar asistencia desde la vista 
//gradoPBJ.blade.php
Route::post('/asistencia/store', [ProfesorPBJController::class, 'storeAsistencia'])->name('asistencia.store');




//Rutas que redirigen a las vistas de los 
//Periodos.
//Primer Periodo 
Route::get('/profesorPBJ/notas/periodo1', [ProfesorPBJController::class, 'primerPeriodo'])->name('notas.primerPeriodo');
//Segundo Periodo 
Route::get('/profesorPBJ/notas/periodo2', [ProfesorPBJController::class, 'segundoPeriodo'])->name('notas.segundoPeriodo');
// Tercer periodo
Route::get('/profesorPBJ/notas/periodo3', [ProfesorPBJController::class, 'tercerPeriodo'])->name('notas.tercerPeriodo');
// Cuarto periodo
Route::get('/profesorPBJ/notas/periodo4', [ProfesorPBJController::class, 'cuartoPeriodo'])->name('notas.cuartoPeriodo');







//Rutas para cargar, crear, editar y eliminar
//Materias desde la vista crearMateriaPBJ.blade.php
Route::get('/materias-pbj', [MateriaPBJController::class, 'index'])->name('materiasPBJ.index');
Route::post('/materias-pbj', [MateriaPBJController::class, 'store'])->name('materiasPBJ.store');
Route::put('/materias-pbj/{id}', [MateriaPBJController::class, 'update'])->name('materiasPBJ.update');
Route::delete('/materias-pbj/{id}', [MateriaPBJController::class, 'destroy'])->name('materiasPBJ.destroy');





//Ruta para traer todas las materias creadas a la vista:
//periodo1PBJ.blade.php
Route::middleware(['auth:usuariospbj'])->group(function() {
    Route::get('/profesoresPBJ/notas/periodo1', [ProfesorPBJController::class, 'primerPeriodo'])->name('profesorPBJ.periodo1');
});


//Ruta para traer todas las materias creadas a la vista:
//periodo2PBJ.blade.php
Route::middleware(['auth:usuariospbj'])->group(function (){
    route::get('/profesoresPBJ/notas/periodo2', [ProfesorPBJController::class, 'segundoPeriodo'])->name('profesorPBJ.periodo2');
});


//Ruta para traer todas las materias creadas a la vista:
//periodo3PBJ.blade.php
Route::middleware(['auth.usuariospbj'])->group(function (){
    route::get('/profesoresPBJ/notas/periodo3', [ProfesorPBJController::class, 'tercerPeriodo'])->name('profesorPBJ.periodo3');
});



//Ruta para traer todas las materias creadas a la vista:
//periodo4PBJ.blade.php
Route::middleware(['auth.usuariospbj'])->group(function (){
    Route::get('/profesoresPBJ/notas/periodo4', [ProfesorPBJController::class, 'cuartoPeriodo'])->name('profesorPBJ.periodo4');
});





//Rutas para guardar Notas
// Route::get('/profesorPBJ/periodo1', [ProfesorPBJController::class, 'primerPeriodo'])->name('profesorPBJ.periodo1');
Route::post('/profesorPBJ/guardarNotas', [ProfesorPBJController::class, 'guardarNotas'])->name('profesorPBJ.guardarNotas');

// Nueva ruta para obtener notas por materia (AJAX)
Route::get('/profesorPBJ/periodo1/notas', [ProfesorPBJController::class, 'obtenerNotas'])->name('profesorPBJ.periodo1.notas');



//Rutas para guardar y mostrar las notas 
//En la vista periodo2PBJ.blade.php
// Route::post('/profesorPBJ/periodo2/guardar', [ProfesorPBJController::class, 'guardarNotasSegundoPeriodo'])->name('profesorPBJ.periodo2.Guardar');
Route::get('profesorPBJ/periodo2/mostrar', [ProfesorPBJController::class, 'mostrarNotasSegundoPeriodo'])->name('profesorPBJ.periodo2.mostrar');
//Ruta para guardar las notas del segundo periodo
Route::post('/profesorPBJ/notas/periodo2', [ProfesorPBJController::class, 'guardarPeriodo2'])->name('profesorPBJ.guardarPeriodo2');

