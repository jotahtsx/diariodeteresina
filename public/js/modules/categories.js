export const initCategoryBar = async () => {
    const listContainer = document.getElementById('categories-list');
    if (!listContainer) return;

    try {
        const response = await fetch('http://127.0.0.1:8000/api/categorias');
        
        if (!response.ok) throw new Error('Erro na API');

        const result = await response.json();
        const categories = result.data || result;

        if (!Array.isArray(categories) || categories.length === 0) {
            listContainer.innerHTML = '<span class="text-gray-400 text-xs font-bold uppercase tracking-widest">Teresina</span>';
            return;
        }

        listContainer.innerHTML = categories.slice(0, 6).map(cat => `
            <a href="/categoria/${cat.slug}" 
               class="text-gray-600 hover:text-[#EA2027] font-semibold text-[13px] transition-all duration-300 hover:opacity-70 whitespace-nowrap">
               ${cat.name.toUpperCase()}
            </a>
        `).join('');

    } catch (error) {
        console.error('Erro no Fetch:', error);
        listContainer.innerHTML = '<span class="text-gray-400 text-xs italic text-red-300">Categorias Indisponíveis</span>';
    }
};