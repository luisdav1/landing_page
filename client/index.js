
const selectLevel = document.getElementById("level");
const selectFaculty = document.getElementById("faculty");
const selectModality = document.getElementById("modality");
const coursesHtml = document.getElementById('courses');

async function main() {
    actualizarData();
};

main()

async function actualizarData() {
    const level = selectLevel.value;
    const faculty = selectFaculty.value;
    const modality = selectModality.value;

    const response = await fetch(
        `http://localhost/prueba-tecnica/server/api/courses.php?
        faculty=${faculty}&isVirtual=${modality}&isUnderGraduate=${level}`
    );
    const data = await response.json();
    mostrarData(data);
}

function mostrarData(data) {
    if (data.message) {
        coursesHtml.innerHTML = data.message;
    } else {
        coursesHtml.innerHTML = ''
        data.forEach(({ name, description, isVirtual }) => {
            coursesHtml.innerHTML += `
        <div class="card">
        <div class="card-modality">${isVirtual === '1' ? 'Online' : 'Presencial'}</div>
        <div class="card-title">${name}</div>
        <div class="card-description">
            ${description}
        </div>
        <button>MAS INFORMACION</button>
        </div>`
        });
    }
}

selectLevel.addEventListener("change", () => actualizarData());

selectFaculty.addEventListener("change", () => actualizarData());

selectModality.addEventListener("change", () => actualizarData());