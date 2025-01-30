<template>
    <div>
        <h1 class="text-center text-3xl mb-5">Editar Flashcard</h1>
        <form @submit.prevent="updateFlashcard">
            <div>
                <label for="palabra">Palabra:</label>
                <input
                    type="text"
                    v-model="flashcard.palabra"
                    id="palabra"
                    placeholder="Palabra"
                    required
                    :class="{ 'is-invalid': form.errors.palabra }"
                />
            </div>
            <div>
                <label for="traduccion">Traducción:</label>
                <input
                    type="text"
                    v-model="flashcard.traduccion"
                    id="traduccion"
                    required
                    placeholder="Traducción"
                    :class="{ 'is-invalid': form.errors.traduccion }"
                />
            </div>
            <div>
                <label for="cat_gramatical">Categoría Gramatical:</label>
                <input
                    type="text"
                    v-model="flashcard.cat_gramatical"
                    id="cat_gramatical"
                    placeholder="opcional"
                    :class="{ 'is-invalid': form.errors.cat_gramatical }"
                />
            </div>
            <div>
                <label for="pronunciacion">Pronunciación:</label>
                <input
                    type="text"
                    v-model="flashcard.pronunciacion"
                    id="pronunciacion"
                    placeholder="opcional"
                    :class="{ 'is-invalid': form.errors.pronunciacion }"
                />
            </div>
            <div>
                <label for="frase_ejemplo">Frase de ejemplo:</label>
                <textarea
                    v-model="flashcard.frase_ejemplo"
                    id="frase_ejemplo"
                    required
                    :class="{ 'is-invalid': form.errors.frase_ejemplo }"
                ></textarea>
            </div>
            <div>
                <label for="notas">Notas adicionales:</label>
                <textarea v-model="flashcard.notas" id="notas"></textarea>
            </div>
            <button type="submit" :disabled="form.processing">
                Actualizar
            </button>
        </form>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        flashcard: Object,
    },
    data() {
        return {
            form: {
                palabra: this.flashcard.palabra,
                traduccion: this.flashcard.traduccion,
                cat_gramatical: this.flashcard.cat_gramatical || "",
                pronunciacion: this.flashcard.pronunciacion || "",
                frase_ejemplo: this.flashcard.frase_ejemplo,
                notas: this.flashcard.notas || "",
                errors: {},
                processing: false,
            },
        };
    },
    methods: {
        async updateFlashcard() {
            this.form.errors = {}; // borrar errores anteriores
            this.form.processing = true;

            try {
                await Inertia.put(
                    `/lists/${this.flashcard.list_id}/flashcards/${this.flashcard.id}`,
                    {
                        palabra: this.form.palabra,
                        traduccion: this.form.traduccion,
                        cat_gramatical: this.form.cat_gramatical,
                        pronunciacion: this.form.pronunciacion,
                        frase_ejemplo: this.form.frase_ejemplo,
                        notas: this.form.notas,
                    }
                );
            } catch (e) {
                this.form.errors = e.response.data.errors;
            } finally {
                this.form.processing = false;
            }
        },
    },
};
</script>
