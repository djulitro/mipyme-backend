<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TypePyme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePymeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1,'name' => 'Belleza y Estética', 'description' => 'Servicios de cuidado personal y estética'],
            ['id' => 2,'name' => 'Salud y Bienestar', 'description' => 'Profesionales médicos y terapias'],
            ['id' => 3,'name' => 'Educación y Formación', 'description' => 'Cursos, clases y capacitación'],
            ['id' => 4,'name' => 'Automotriz', 'description' => 'Talleres y servicios de vehículos'],
            ['id' => 5,'name' => 'Servicios para el hogar', 'description' => 'Reparaciones y mantención'],
            ['id' => 6,'name' => 'Creatividad y Producción', 'description' => 'Fotografía, diseño y medios'],
            ['id' => 7,'name' => 'Consultoría y Negocios', 'description' => 'Asesorías y servicios profesionales'],
            ['id' => 8,'name' => 'Mascotas', 'description' => 'Veterinaria y servicios para animales'],
            ['id' => 9,'name' => 'Eventos y Entretenimiento', 'description' => 'Organización de eventos y shows'],
            ['id' => 10,'name' => 'Otros', 'description' => 'Categorías varias'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        $types = [
            // --- Belleza y Estética ---
            ['category_id' => 1, 'name' => 'Peluquerías', 'description' => 'Corte y peinado'],
            ['category_id' => 1, 'name' => 'Barberías', 'description' => 'Cuidado y estilo masculino'],
            ['category_id' => 1, 'name' => 'Spa', 'description' => 'Relajación y tratamientos corporales'],
            ['category_id' => 1, 'name' => 'Centros de estética', 'description' => 'Servicios de belleza'],
            ['category_id' => 1, 'name' => 'Podólogos', 'description' => 'Cuidado de pies'],
            ['category_id' => 1, 'name' => 'Tratamientos capilares', 'description' => 'Salud y estética del cabello'],
            ['category_id' => 1, 'name' => 'Bronceado artificial', 'description' => 'Camas solares y bronceado'],
            ['category_id' => 1, 'name' => 'Tatuadores', 'description' => 'Estudios de tatuajes'],
            ['category_id' => 1, 'name' => 'Piercings', 'description' => 'Perforaciones corporales'],

            // --- Salud y Bienestar ---
            ['category_id' => 2, 'name' => 'Médicos generales', 'description' => 'Atención médica básica'],
            ['category_id' => 2, 'name' => 'Dentistas', 'description' => 'Salud dental'],
            ['category_id' => 2, 'name' => 'Oftalmólogos', 'description' => 'Salud visual'],
            ['category_id' => 2, 'name' => 'Dermatólogos', 'description' => 'Cuidado de la piel'],
            ['category_id' => 2, 'name' => 'Nutricionistas', 'description' => 'Alimentación y salud'],
            ['category_id' => 2, 'name' => 'Psicólogos', 'description' => 'Salud mental'],
            ['category_id' => 2, 'name' => 'Fisioterapeutas', 'description' => 'Rehabilitación física'],
            ['category_id' => 2, 'name' => 'Kinesiólogos', 'description' => 'Terapias físicas'],
            ['category_id' => 2, 'name' => 'Osteópatas', 'description' => 'Terapias alternativas'],
            ['category_id' => 2, 'name' => 'Acupunturistas', 'description' => 'Medicina tradicional china'],
            ['category_id' => 2, 'name' => 'Homeópatas', 'description' => 'Medicina alternativa'],

            // --- Educación y Formación ---
            ['category_id' => 3, 'name' => 'Profesores particulares', 'description' => 'Clases de apoyo escolar'],
            ['category_id' => 3, 'name' => 'Escuelas de música', 'description' => 'Clases de guitarra, piano, canto'],
            ['category_id' => 3, 'name' => 'Escuelas de conducción', 'description' => 'Clases de manejo'],
            ['category_id' => 3, 'name' => 'Cursos de informática', 'description' => 'Capacitación en tecnología'],
            ['category_id' => 3, 'name' => 'Cursos de cocina', 'description' => 'Repostería y gastronomía'],
            ['category_id' => 3, 'name' => 'Guarderías y talleres infantiles', 'description' => 'Cuidado y educación de niños'],

            // --- Automotriz ---
            ['category_id' => 4, 'name' => 'Talleres mecánicos', 'description' => 'Reparación de autos'],
            ['category_id' => 4, 'name' => 'Electricistas automotrices', 'description' => 'Sistemas eléctricos'],
            ['category_id' => 4, 'name' => 'Tapicería automotriz', 'description' => 'Restauración interior'],
            ['category_id' => 4, 'name' => 'Cambio de neumáticos', 'description' => 'Revisión y reemplazo de llantas'],
            ['category_id' => 4, 'name' => 'Servicios de grúa', 'description' => 'Asistencia en ruta'],
            ['category_id' => 4, 'name' => 'Arriendo de autos', 'description' => 'Rent a car'],

            // --- Servicios para el hogar ---
            ['category_id' => 5, 'name' => 'Cerrajeros', 'description' => 'Apertura e instalación de cerraduras'],
            ['category_id' => 5, 'name' => 'Plomeros', 'description' => 'Servicios de gasfitería'],
            ['category_id' => 5, 'name' => 'Electricistas', 'description' => 'Instalaciones y reparaciones'],
            ['category_id' => 5, 'name' => 'Servicios de mudanza', 'description' => 'Transporte y embalaje'],
            ['category_id' => 5, 'name' => 'Albañiles', 'description' => 'Construcción y reparación'],
            ['category_id' => 5, 'name' => 'Pintores', 'description' => 'Pintura de interiores y exteriores'],
            ['category_id' => 5, 'name' => 'Aire acondicionado', 'description' => 'Instalación y mantención'],

            // --- Creatividad y Producción ---
            ['category_id' => 6, 'name' => 'Fotógrafos', 'description' => 'Sesiones fotográficas'],
            ['category_id' => 6, 'name' => 'Videógrafos', 'description' => 'Producción audiovisual'],
            ['category_id' => 6, 'name' => 'Ilustradores', 'description' => 'Arte gráfico y digital'],
            ['category_id' => 6, 'name' => 'Locutores', 'description' => 'Grabación de voz profesional'],
            ['category_id' => 6, 'name' => 'Streaming', 'description' => 'Servicios técnicos en vivo'],
            ['category_id' => 6, 'name' => 'Modelos', 'description' => 'Agencias y casting'],

            // --- Consultoría y Negocios ---
            ['category_id' => 7, 'name' => 'Abogados', 'description' => 'Servicios legales'],
            ['category_id' => 7, 'name' => 'Contadores', 'description' => 'Gestión financiera'],
            ['category_id' => 7, 'name' => 'Consultores de RRHH', 'description' => 'Reclutamiento y capacitación'],
            ['category_id' => 7, 'name' => 'Asesores financieros', 'description' => 'Gestión de inversiones'],
            ['category_id' => 7, 'name' => 'Mentores de startups', 'description' => 'Asesoría en negocios'],
            ['category_id' => 7, 'name' => 'Asesores inmobiliarios', 'description' => 'Compra y arriendo de propiedades'],
            ['category_id' => 7, 'name' => 'Brokers de seguros', 'description' => 'Gestión de pólizas'],

            // --- Mascotas ---
            ['category_id' => 8, 'name' => 'Veterinarios', 'description' => 'Atención médica animal'],
            ['category_id' => 8, 'name' => 'Paseadores de perros', 'description' => 'Paseos por horas'],
            ['category_id' => 8, 'name' => 'Guarderías caninas', 'description' => 'Cuidado diario de mascotas'],

            // --- Eventos y Entretenimiento ---
            ['category_id' => 9, 'name' => 'Catering', 'description' => 'Banquetería'],
            ['category_id' => 9, 'name' => 'Decoradores de eventos', 'description' => 'Ambientación y organización'],
            ['category_id' => 9, 'name' => 'Wedding planners', 'description' => 'Planificación de matrimonios'],
            ['category_id' => 9, 'name' => 'Músicos en vivo', 'description' => 'Bandas y solistas'],
            ['category_id' => 9, 'name' => 'Stand-up comedy', 'description' => 'Entretenimiento en vivo'],
            ['category_id' => 9, 'name' => 'Fotocabinas', 'description' => 'Cabinas fotográficas para eventos'],

            // --- Otros ---
            ['category_id' => 10, 'name' => 'Coworking', 'description' => 'Arriendo de espacios compartidos'],
            ['category_id' => 10, 'name' => 'Centros de reuniones', 'description' => 'Arriendo de salas'],
            ['category_id' => 10, 'name' => 'Gimnasios', 'description' => 'Entrenamiento físico'],
            ['category_id' => 10, 'name' => 'Estudios de danza', 'description' => 'Clases de baile'],
            ['category_id' => 10, 'name' => 'Servicios de impresión', 'description' => 'Plotter y diseño gráfico'],
        ];

        foreach ($types as $type) {
            TypePyme::create($type);
        }
    }
}
