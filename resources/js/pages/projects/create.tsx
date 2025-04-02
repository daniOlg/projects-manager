import {Link, router, useForm} from '@inertiajs/react';
import {FormEventHandler, useEffect} from 'react';
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-react';
import AppLayout from '@/layouts/app-layout';
import { toast } from 'sonner';
import Form, { ProjectFormData } from '@/pages/projects/form';

function Create() {
    const { data, setData, post, processing, errors, reset } = useForm<Required<ProjectFormData>>({
        name: '',
        start_date: '',
        status: '',
        responsible: '',
        amount: '',
    });

    useEffect(() => {
        reset();
    }, [reset]);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('projects.store'), {
            onSuccess: () => {
                toast('Project created successfully', {
                    description: 'The project has been created successfully.',
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
                        Create project
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

export default Create;
