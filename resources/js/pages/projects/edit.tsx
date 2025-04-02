import { Project } from '@/pages/projects/types';
import { Link, router, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-react';
import { toast } from 'sonner';
import AppLayout from '@/layouts/app-layout';
import Form, { ProjectFormData } from '@/pages/projects/form';

type EditProps = {
    project: Project;
};

function Edit({ project }: EditProps) {
    const { data, setData, put, processing, errors } = useForm<Required<ProjectFormData>>({
        name: project.name,
        start_date: project.start_date,
        status: project.status,
        responsible: project.responsible,
        amount: project.amount,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        put(route('projects.update', project.id), {
            onSuccess: () => {
                toast('Project updated successfully', {
                    description: 'The project has been updated successfully.',
                    duration: 5000,
                    action: {
                        label: 'Close',
                        onClick: () => toast.dismiss(),
                    },
                });
            },
            onFinish: () => {
                router.visit(route('projects.index'));
            },
        });
    };

    return (
        <AppLayout>
            <div className="p-4">
                <form className="grid gap-6 rounded-xl border p-4" onSubmit={submit}>
                    <Form data={data} setData={setData} processing={processing} errors={errors} />

                    <Button type="submit" className="mt-2 w-full" tabIndex={5} disabled={processing}>
                        {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                        Edit Project
                    </Button>
                    <Link href={route('projects.index')} className="w-full">
                        <Button variant="secondary" className="w-full">
                            Back to projects
                        </Button>
                    </Link>
                </form>
            </div>
        </AppLayout>
    );
}

export default Edit;
